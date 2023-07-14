

importScripts("https://www.gstatic.com/firebasejs/7.8.1/firebase-app.js")
importScripts("https://www.gstatic.com/firebasejs/7.8.1/firebase-messaging.js")

var firebaseConfig = {
                apiKey: "AIzaSyDurcwUWqiwbc2sCa42ViYePve85NM9Nmg",
                authDomain: "myguard-b07b0.firebaseapp.com",
                databaseURL: "https://myguard-b07b0.firebaseio.com",
                projectId: "myguard-b07b0",
                storageBucket: "myguard-b07b0.appspot.com",
                messagingSenderId: "433343975019",
                appId: "1:433343975019:web:4eb752b9abf78db0b76b2e",
                measurementId: "G-G3CDMYJSRJ"
            };

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    var notificationTitle = 'Background Message Title';
    var notificationOptions = {
        body: 'Background Message body.',
        icon: '/firebase-logo.png'
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
    });
