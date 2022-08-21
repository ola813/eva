
const firebaseConfig = {

    apiKey: "AIzaSyAjNoVV5aHSh84KAEcQbYZRplhT6IcHVcw",
  
    authDomain: "auth-development-42586.firebaseapp.com",
  
    projectId: "auth-development-42586",
  
    storageBucket: "auth-development-42586.appspot.com",
  
    messagingSenderId: "222852278489",
  
    appId: "1:222852278489:web:7a7ee348be7ead5b5a76c8"
  
  };
  //=============================
  firebase.initializeApp(firebaseConfig);
//  const messageing = firebase.messageing();
const messaging = firebase.messaging();
messaging.requestPermission()
    .then(function(){
        console.log('ola this is create notifcation')
        return messaging.getToken();


    }).
    then(function(token){
        $('#device_token').val(token);

        console.log(token);
        // alert(token);
    }).
    catch(function(err){
        console.log('this is error notifcation',err)
    });

    //===================================
    messaging.onMessage((payload)=>{
        console.log(payload);
    $('.number-alert').empty().html(payload.data['gcm.notifcation.badge'])
    $('.number-message').empty().html("يوجد"+payload.data['gcm.notifcation.badge'+"إشعارات"])
    })