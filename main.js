const elements = document.querySelectorAll('.sidebar ul li')

elements.forEach(element => {
element.addEventListener('contextmenu', function(event) {
    event.preventDefault();
    alert('Right-click detected on friend');
});
});

function eclipsePrompt(text, placeholder) {
    const popupCont = document.querySelector('.popup-container')
     document.querySelector('.popup-container').style.visibility = "visible"
         document.querySelector('.popup-container').classList.add('show')
    popupCont.insertAdjacentHTML("beforeend", '<div class="popup user-popup"><h3>' + text + '</h3><div class="join-hori"><input type="text" placeholder="' + placeholder + '"><button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none"><path d="M6.83333 1.5L11 5.66667M11 5.66667L6.83333 9.83333M11 5.66667H1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button></div></div>')
    const popup = document.querySelector('.user-popup')
    popup.style.visibility = "visible"
    return new Promise((resolve, reject) => {
     popup.children[1].children[0].onkeydown = function(event) {
       if (event.key == "Enter") {
          popup.children[1].children[1].click()
       }
     }
     popup.children[1].children[1].onclick = function() {
        
        document.querySelector('.popup-container').style.visibility = "hidden"
        popup.remove()
        const value = popup.children[1].children[0].value
        resolve(value)
      }
    });
    }
        

    document.querySelector('.popup-container').addEventListener('click', function(event) {
        var element = document.querySelector('.popup');
     if (element.matches(':hover')) {
         console.log('Mouse is over the element now.');
     } else {
          document.querySelector('.popup-container').style.visibility = "hidden"
       document.querySelectorAll('.popup').forEach((child) => {
         child.remove()
       })
        document.querySelector('.popup-container').classList.remove('show')
     }
      })
     