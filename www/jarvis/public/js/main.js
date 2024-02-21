let elements = document.getElementsByTagName('a');
let headers = document.querySelectorAll('h1, h2, h3');

for (let i = 0; i < elements.length; i++) {
  let element = elements[i];
  
  // Check if the link is pointing to a header on the same page
  if (element.hash && element.pathname == window.location.pathname) {
    let targetHeaders = Array.from(headers).filter(header => header.innerHTML === element.innerHTML);
    
    // Check if the target headers exist on the page
    if (targetHeaders.length) {
      element.addEventListener('click', function(event) {
        event.preventDefault();
        let targetHeader = targetHeaders[0];
        let targetOffset = targetHeader.offsetTop;
        window.scrollTo({
          top: targetOffset,
          behavior: 'smooth'
        });
      });
    }
  }
}