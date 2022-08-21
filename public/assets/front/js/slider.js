// $('.slider').each(function() {              // For every slider
//     var $this   = $(this);                    // Current slider
//     var $group  = $this.find('.slide-group'); // Get the slide-group (container)
//     var $slides = $this.find('.slide');       // Create jQuery object to hold all slides
//     var buttonArray  = [];                    // Create array to hold navigation buttons
//     var currentIndex = 0;                     // Hold index number of the current slide
//     var timeout;                              // Sets gap between auto-sliding
  
//     function move(newIndex) {          // Creates the slide from old to new one
//       var animateLeft, slideLeft;      // Declare variables
  
//       advance();                       // When slide moves, call advance() again
  
//       // If it is the current slide / animating do nothing
//       if ($group.is(':animated') || currentIndex === newIndex) {  
//         return;
//       }
  
//       buttonArray[currentIndex].removeClass('active'); // Remove class from item
//       buttonArray[newIndex].addClass('active');        // Add class to new item
  
//       if (newIndex > currentIndex) {   // If new item > current
//         slideLeft = '100%';            // Sit the new slide to the right
//         animateLeft = '-100%';         // Animate the current group to the left
//       } else {                         // Otherwise
//         slideLeft = '-100%';           // Sit the new slide to the left
//         animateLeft = '100%';          // Animate the current group to the right
//       }
//       // Position new slide to left (if less) or right (if more) of current
//       $slides.eq(newIndex).css( {left: slideLeft, display: 'block'} );
  
//       $group.animate( {left: animateLeft}, function() {    // Animate slides and
//         $slides.eq(currentIndex).css( {display: 'none'} ); // Hide previous slide      
//         $slides.eq(newIndex).css( {left: 0} ); // Set position of the new item
//         $group.css( {left: 0} );               // Set position of group of slides
//         currentIndex = newIndex;               // Set currentIndex to the new image
//       });
//     }
  
//     function advance() {                     // Used to set 
//       clearTimeout(timeout);                 // Clear previous timeout
//       timeout = setTimeout(function() {      // Set new timer
//         if (currentIndex < ($slides.length - 1)) { // If slide < total slides
//           move(currentIndex + 1);            // Move to next slide
//         } else {                             // Otherwise
//           move(0);                           // Move to the first slide
//         }
//       }, 4000);                              // Milliseconds timer will wait
//     }
  
//     $.each($slides, function(index) {
//       // Create a button element for the button
//       var $button = $('<button type="button" class="slide-btn button">&bull;</button>');
//       if (index === currentIndex) {    // If index is the current item
//         $button.addClass('active');    // Add the active class
//       }
//       $button.on('click', function() { // Create event handler for the button
//         move(index);                   // It calls the move() function
//       }).appendTo('.slide-buttons');   // Add to the buttons holder
//       buttonArray.push($button);       // Add it to the button array
//     });
  
//     advance();                          // Script is set up, advance() to move it
//   // autoplay slides --------
//   let slideIndex = 0;
//   showSlides();
  
//   // Next-previous control
//   function nextSlide() {
//     slideIndex++;
//     showSlides();
//     timer = _timer; // reset timer
//   }
  
//   function prevSlide() {
//     slideIndex--;
//     showSlides();
//     timer = _timer;
//   }
  
//   // Thumbnail image controlls
//   function currentSlide(n) {
//     slideIndex = n - 1;
//     showSlides();
//     timer = _timer;
//   }
  
//   function showSlides() {
//     let slides = document.querySelectorAll(".mySlides");
//     let dots = document.querySelectorAll(".dots");
  
//     if (slideIndex > slides.length - 1) slideIndex = 0;
//     if (slideIndex < 0) slideIndex = slides.length - 1;
    
//     // hide all slides
//     slides.forEach((slide) => {
//       slide.style.display = "none";
//     });
    
//     // show one slide base on index number
//     slides[slideIndex].style.display = "block";
    
//     dots.forEach((dot) => {
//       dot.classList.remove("active");
//     });
    
//     dots[slideIndex].classList.add("active");
//   }
  
//   // autoplay slides --------
//   let timer = 7; // sec
//   const _timer = timer;
  
//   // this function runs every 1 second
//   setInterval(() => {
//     timer--;
  
//     if (timer < 1) {
//       nextSlide();
//       timer = _timer; // reset timer
//     }
//   }, 1000);
// });
// 1sec
// ===============================================================================
const images = document.querySelectorAll(".slide"),
  next = document.querySelector(".next"),
  prev = document.querySelector(".prev");

let current = 0;

function changeImage() {
  images.forEach(img => {
    img.classList.remove("show");
    img.style.display = "none";
  });

  images[current].classList.add("show");
  images[current].style.display = "block";
}

// Calling first time
changeImage();

next.addEventListener("click", function() {
  current++;

  if (current > images.length - 1) {
    current = 0;
  } else if (current < 0) {
    current = images.length - 1;
  }

  changeImage();
});
prev.addEventListener("click", function() {
  current--;

  if (current > images.length - 1) {
    current = 0;
  } else if (current < 0) {
    current = images.length - 1;
  }

  changeImage();
});

// Auto change in 5 seconds

setInterval(() => {
  next.click();
}, 5000);
