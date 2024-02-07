function b2bLogin(redirectIfLoggedIn = true) {
    return {
        polyglot: null,
        language: "en",
        allowedLanguages: ["en", "de"],
        loading: false,
        email: null,
        password: null,
        confirmPassword: null,
        redirecting: false, // true if we are redirecting through continueSSO().
        errorState: null,
        flash: null,
        token: null,
        loggedOut: false,
        init() {
            let component = this

            // Redirect the user if already logged in.
            if (redirectIfLoggedIn === true) {
                this.ifLoggedIn(() => component.continueSSO())
            }

            let language = localStorage.getItem("language")

            if (!language) {
                language = this.getBrowserLanguage()
            }

            this.setLanguage(language)

            history.pushState({url: document.location.href}, "", document.location.href)
        },
        initResetPassword(config) {
            this.token = config.token
        },
        ifLoggedIn(loginCallback) {
            if (typeof gigya === "undefined") {
                this.errorState = "gigya-not-loaded"
            } else {
                gigya.accounts.getJWT({
                    callback: (response) => {
                        if (response.errorCode === 0) {
                            if (typeof loginCallback === "function") {
                                loginCallback(response.id_token)
                            }
                        }
                    },
                })
            }
        },
        continueSSO() {
            this.redirecting = true
            gigya.fidm.saml.continueSSO()
        },
        login() {
            if (typeof gigya === "undefined") {
                this.loginFailed(null)
                return
            }

            let component = this
            let timer = setTimeout(() => component.loginFailed(null, true), 10000)
            this.errorState = this.flash = null
            this.loading = true

            gigya.accounts.login({
                loginID: this.email,
                password: this.password,
                callback: (response) => {
                    clearTimeout(timer)
                    if (response.errorCode === 0) {
                        component.loading = false
                        component.continueSSO()
                    } else {
                        component.loading = false
                        component.loginFailed(response)
                    }
                },
            })
        },
        logout() {
            let component = this
            this.errorState = this.flash = null
            this.loggedOut = false

            gigya.accounts.logout({
                callback: (response) => {
                    if (response.errorCode === 0) {
                        component.loggedOut = true
                    } else {
                        component.errorState = "logout-fail"
                    }
                }
            })
        },
        resetPassword() {
            this.errorState = this.flash = null

            this.callResetPassword({loginID: this.email}, (response) => fetchContent("/reset-success.php"))
        },
        setPassword() {
            if (!this.password) {
                this.errorState = "password-missing"
                return
            }

            if (this.confirmPassword !== this.password) {
                this.errorState = "new-password-mismatch"
                return
            }

            this.callResetPassword({
                passwordResetToken: this.token,
                newPassword: this.password
            }, (response) => fetchContent("/password-success.php"))
        },
        callResetPassword(payload, onSuccess) {
            let component = this
            this.loading = true

            if (typeof gigya === "undefined") {
                this.errorState = "gigya-not-loaded"
            } else {
                gigya.accounts.resetPassword({
                    ...payload,
                    callback: (response) => {
                        this.loading = false

                        if (response.errorCode === 0) {
                            if (typeof onSuccess === "function") {
                                onSuccess(response)
                            }
                        } else {
                            let errorCodes = parseErrorResponse(response)

                            errorCodes.forEach(function (code) {
                                switch (code) {
                                    case 400002:
                                        component.errorState = "email-missing"
                                        break
                                    case 403025:
                                        component.errorState = "link-expired"
                                        break
                                    case 403047:
                                        component.errorState = "email-unknown"
                                        break
                                    default:
                                        component.errorState = "unknown"
                                }
                            })
                        }
                    },
                })
            }
        },
        loginFailed(response = null, isTimeout = false) {
            if (response !== null) {
                let errorCodes = parseErrorResponse(response)
                let component = this

                errorCodes.forEach(function (code) {
                    if (!component.errorState) {
                        switch (code) {
                            case 400002:
                                component.errorState = "parameter-missing"
                                break
                            case 403042:
                                component.errorState = "invalid-credentials"
                                break
                            default:
                                component.errorState = "unknown"
                        }
                    }
                })
            } else {
                this.errorState = isTimeout ? "login-timeout" : (typeof gigya === "undefined" ? "gigya-not-loaded" : "network-error")
            }

            this.loading = false
        },
        getBrowserLanguage() {
            let language = 'en'
            let component = this

            navigator.languages.some((lang) => {
                lang = lang.split('-')[0]
                return component.allowedLanguages.includes(lang) && (language = lang)
            })

            return language
        },
        setLanguage(language) {
            this.language = language
            localStorage.setItem("language", language)
            this.loadTranslations(this.language)
        },
        loadTranslations(language = "en") {
            let component = this

            fetch("/i18n/" + language + ".json")
                .then((response) => response.json())
                .then((phrases) => component.polyglot = new Polyglot({phrases}))
                .catch((error) => console.warn(error))
        },
        t(phrase, fallback, options = {}) {
            if (phrase && this.polyglot) {
                return this.polyglot.t(phrase, {...options, '_': fallback})
            } else {
                return fallback || phrase
            }
        }
    }
}

window.onpopstate = function (event) {
    fetchContent(event.state && event.state.hasOwnProperty('url') ? event.state.url : '/', true)
}

function loadContent(event) {
    fetchContent(event.target.getAttribute('href'))
}

function fetchContent(path, historyLoad = false) {
    let url = new URL(path, window.location.origin)
    url.searchParams.append('headless', 1)

    fetch(url)
        .then((response) => response.text())
        .then((text) => {
            if (!historyLoad) {
                history.pushState({url: path}, "", path)
            }
            setContent(text)
        })
        .catch((error) => console.warn(error))
}

function setContent(content) {
    let contentDiv = document.getElementById('content')
    contentDiv.innerHTML = content
}

function parseErrorResponse(response) {
    let errorCodes = []
    let errorCode = 0

    if (response) {
        if (response.hasOwnProperty("errorCode")) {
            errorCode = parseInt(response.errorCode)
        }

        if (response.hasOwnProperty("validationErrors")) {
            let validationErrors = response.validationErrors

            if (validationErrors) {
                errorCodes = validationErrors.map(
                    validationError => validationError.errorCode,
                )
            }
        }

        return errorCodes.length > 0 ? errorCodes : [errorCode]
    }

    return []
}