const slides = document.querySelector('.slides');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

if (slides && prevButton && nextButton) {
  let slideIndex = 0;
  const slideWidth = slides.firstElementChild.clientWidth;
  const numSlides = slides.children.length;

  function showSlide(index) {
    if (index < 0) {
      slideIndex = numSlides - 1;
    } else if (index >= numSlides) {
      slideIndex = 0;
    }
    slides.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
  }

  prevButton.addEventListener('click', () => {
    slideIndex--;
    showSlide(slideIndex);
  });

  nextButton.addEventListener('click', () => {
    slideIndex++;
    showSlide(slideIndex);
  });
}