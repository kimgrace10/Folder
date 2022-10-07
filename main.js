//variables

var openBtn = document.getElementById('open-btn');
var formContainer = document.getElementById('form-container');
var closeBtn = document.getElementById('close-btn');
var closeModal = document.getElementById('close-modal');


//event listeners

openBtn.addEventListener('click', function(){

    formContainer.style.display = 'block';
});

closeBtn.addEventListener('click', function(){

    formContainer.style.display = 'none';
});

openBtn.addEventListener('click', function(){
    
    closeModal.style.display ='block';
});

closeModal.addEventListener('click', function(){
    formContainer.style.display = 'none';
});

window.addEventListener('click', function(e){

    if(e.target === closeModal) {
        closeModal.style.display = 'none';
    }
});


//clear input field
const closeBtns = document.getElementById('close-btn');

closeBtn.addEventListener('click', function handleClick(event){
    
    event.preventDefault();
    if(inputs.value === '') {
        pEvent.preventDefault();
        alert('Testing');
    }
    const inputs = document.querySelectorAll('#box1, #box2, #fname, #zpcode, #email, #phonenum, #message-box');
    inputs.forEach(input => {
        input.value = '';
    });

});



//view more 
function myFunction() {
  
    if (moreText.style.display === "hide") {
      moreText.style.display = "inline";
      btnText.innerHTML = "Read more";
      dots.style.display = "none";
    } else {
      moreText.style.display = "none";
      btnText.innerHTML = "Read less";
      dots.style.display = "none";
    }
  }


  //FAq

const accordionContent = document.getElementsByClassName('.content-container');

for( i = 0, i < accordionContent.length; i++;) {
    accordionContent[i].addEventListener('click', function(){
        this.classList.toggle('active')
    })
}