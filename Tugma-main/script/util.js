let mode = false;
document.getElementById('mode').addEventListener('click',()=>{

  if(document.querySelector('.data-container').getAttribute('data-mode')==='false'){
mode=true;
    document.querySelector('.data-container').setAttribute('data-mode','true');
  }
else{
mode=false
  document.querySelector('.data-container').setAttribute('data-mode','false');
}

setCookie('mode',mode,10);

});

function setCookie(name, value, expirationHours) {
  const date = new Date();
  date.setTime(date.getTime() + (expirationHours * 60 * 60 * 1000));
  document.cookie = `${name}=${value}; expires=${date.toUTCString()}; path=/`;
}
function getCookie(name) {
  const cookies = document.cookie.split(';');
  for (const cookie of cookies) {
    const [cookieName, cookieValue] = cookie.split('=');
    if (cookieName.trim() === name) {
      return decodeURIComponent(cookieValue);
    }
  }
  return null;
}
const modeValue = getCookie('mode');

if(modeValue ==='true'){
  mode=true;
      document.querySelector('.data-container').setAttribute('data-mode','true');
    }
  else{
  mode=false
    document.querySelector('.data-container').setAttribute('data-mode',mode,10);
  }