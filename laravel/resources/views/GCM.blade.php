<!DOCTYPE html>
<html>
	<head>
		<title>GCMServiceWorker</title>
		<link rel="manifest" href="manifest/GCMmanifest.json">
	</head>
	
	<body>
		<h1>Push Notification codelab</h1>
		<p>This page must be accessed using HTTPS or via localhost.</p>
		<button disabled>Subscribe</button>
	</body>
	
	<script>
	if ('serviceWorker' in navigator) {
		console.log('Service Worker is supported');
		navigator.serviceWorker.register('/js/sw.js').then(function(reg) {
	  		console.log(':^)', reg);
	   		reg.pushManager.subscribe({
	   			//Note: it doesn't support incognito mode;
            	userVisibleOnly: true
        	}).then(function(sub) {
            	console.log('endpoint:', sub.endpoint);
            	//the last part is the subscription ID
        	});
	 	}).catch(function(err) {
	   		console.log(':^(', err);
	 	});
	}
	/*
	var reg;
	var sub;
	var isSubscribed = false;
	var subscribeButton = document.querySelector('button');
	if ('serviceWorker' in navigator) {
	  console.log('Service Worker is supported');
	  navigator.serviceWorker.register('/js/sw.js').then(function() {
	    return navigator.serviceWorker.ready;
	  }).then(function(serviceWorkerRegistration) {
	    reg = serviceWorkerRegistration;
	    subscribeButton.disabled = false;
	    console.log('Service Worker is ready :^)', reg);
	  }).catch(function(error) {
	    console.log('Service Worker Error :^(', error);
	  });
	}
	subscribeButton.addEventListener('click', function() {
	  if (isSubscribed) {
	    unsubscribe();
	  } else {
	    subscribe();
	  }
	});
	function subscribe() {
	  reg.pushManager.subscribe({userVisibleOnly: true}).
	  then(function(pushSubscription){
	    sub = pushSubscription;
	    console.log('Subscribed! Endpoint:', sub.endpoint);
	    subscribeButton.textContent = 'Unsubscribe';
	    isSubscribed = true;
	  });
	}
	function unsubscribe() {
	  sub.unsubscribe().then(function(event) {
	    subscribeButton.textContent = 'Subscribe';
	    console.log('Unsubscribed!', event);
	    isSubscribed = false;
	  }).catch(function(error) {
	    console.log('Error unsubscribing', error);
	    subscribeButton.textContent = 'Subscribe';
	  });
	}*/
	</script>

</html>

