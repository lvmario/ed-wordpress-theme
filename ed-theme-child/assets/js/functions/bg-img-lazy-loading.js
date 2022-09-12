function lazyLoadingBGImages() {
  var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));

  if ("IntersectionObserver" in window) {
    let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          lazyBackgroundObserver.unobserve(entry.target);
        }
      });
    });

    lazyBackgrounds.forEach(function(lazyBackground) {
      lazyBackgroundObserver.observe(lazyBackground);
    });
  }else{
      let active = false;

      const lazyLoad = function() {
        if (active === false) {
          active = true;

          setTimeout(function() {
            lazyBackgrounds.forEach(function(lazyImage) {
              if (( lazyImage.getBoundingClientRect().top <= window.innerHeight && 
                      lazyImage.getBoundingClientRect().bottom >= 0) && 
                          getComputedStyle(lazyImage).display !== "none") {

                lazyImage.classList.add("visible");

                lazyImages = lazyImages.filter(function(image) {
                  return image !== lazyImage;
                });

                if (lazyImages.length === 0) {
                  document.removeEventListener("scroll", lazyLoad);
                  window.removeEventListener("resize", lazyLoad);
                  window.removeEventListener("orientationchange", lazyLoad);
                }
              }
            });

            active = false;
          }, 200);
        }
      };

      document.addEventListener("scroll", lazyLoad);
      window.addEventListener("resize", lazyLoad);
      window.addEventListener("orientationchange", lazyLoad);
  }
}

export {lazyLoadingBGImages};