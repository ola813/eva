importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
const firebaseConfig = {

  apiKey: "AIzaSyAjNoVV5aHSh84KAEcQbYZRplhT6IcHVcw",

  authDomain: "auth-development-42586.firebaseapp.com",

  projectId: "auth-development-42586",

  storageBucket: "auth-development-42586.appspot.com",

  messagingSenderId: "222852278489",

  appId: "1:222852278489:web:7a7ee348be7ead5b5a76c8"

};

firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: 'https://images.theconversation.com/files/93616/original/image-20150902-6700-t2axrz.jpg' //your logo here
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});