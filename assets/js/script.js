let slideIndex = 0;
showSlide();

function changeSlide(n) {
  showSlide(slideIndex += n);
}

function showSlide() {
  const slides = document.getElementsByClassName("slide");

  // Wrap around to the first slide if reached the end
  if (slideIndex >= slides.length) {
    slideIndex = 0;
  } else if (slideIndex < 0) {
    slideIndex = slides.length - 1;
  }

  // Hide all slides except the current one
  for (let i = 0; i < slides.length; i++) {
    slides[i].classList.remove("active", "previous", "next");
  }

  slides[slideIndex].classList.add("active");

  if (slideIndex > 0) {
    slides[slideIndex - 1].classList.add("previous");
  } else {
    slides[slides.length - 1].classList.add("previous");
  }

  if (slideIndex < slides.length - 1) {
    slides[slideIndex + 1].classList.add("next");
  } else {
    slides[0].classList.add("next");
  }

  // Increment slideIndex for the automatic slideshow
  slideIndex++;

  // Repeat the function after 3 seconds (adjust as needed)
  setTimeout(showSlide, 3000); // 3 seconds interval for automatic slideshow
}
