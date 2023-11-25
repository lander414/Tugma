const signupToggle =document.querySelector('#signup-toggle');
let signup = document.querySelector('#signup');
let signin = document.querySelector('#signin');
let blur = document.querySelector('.blur');
signupToggle.addEventListener('click', ()=>{
  if(signup.getAttribute('data-signup-shown')==='false'){
    signup.setAttribute('data-signup-shown','true');
    signin.setAttribute('data-signin-shown','false');
    
  }
  else
    signup.setAttribute('data-signup-shown','false');

    if(signup.getAttribute('data-signup-shown')==='false' && signin.getAttribute('data-signin-shown')==='false'){
      blur.setAttribute('data-blur','false');
    }else{
      blur.setAttribute('data-blur','true');
    }
  
});

const signinToggle = document.querySelector('#signin-toggle');
signinToggle.addEventListener('click',()=>{
if(signin.getAttribute('data-signin-shown')==='false'){
  signin.setAttribute('data-signin-shown','true');
  signup.setAttribute('data-signup-shown','false');
}
  else
    signin.setAttribute('data-signin-shown','false');

    if(signup.getAttribute('data-signup-shown')==='false' && signin.getAttribute('data-signin-shown')==='false'){
      blur.setAttribute('data-blur','false');
    }else{
      blur.setAttribute('data-blur','true');
    }
});
