const Notifier = (options, app) => {

    let message = options.message
    let messages = options.messages
    let toastOptions = {
        title: options.title || "Notification",
    }

    if (options.status === 'success') {
        toastOptions.variant = "success"
        toastOptions.autoHideDelay = options.timeout || 1000
    } else if (options.status === 'error') {
        toastOptions.variant = 'danger'
        toastOptions.autoHideDelay = options.timeout || 5000
    }

    return {
        notify: () => {
            if (Array.isArray(messages) && messages.length) {
                messages.forEach((message) => {
                    app.$root.$bvToast.toast(message, toastOptions)
                })
            } else {
                app.$root.$bvToast.toast(message, toastOptions)
            }
        }
    }
}

export default Notifier
