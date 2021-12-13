function getConfirmation(txt,url)
{
  $c = confirm(txt)
  if($c)
  {
    window.location.href= url;
  }
}