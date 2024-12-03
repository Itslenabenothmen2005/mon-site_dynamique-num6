function test() {
  var email = document.getElementById("mail").value;
  var mp = document.getElementById("mp").value;
  var g = document.getElementById("genre").selectedIndex;

  if (!mdp(mp)) {
    alert("pb de mot de passe");
    return false;
  }
  if (verifemail(email) == false) {
    alert("pb de email");
    return false;
  }
  if (g == 0) {
    alert("il faut saisir le genre");
    return false;
  }
  if (
    !(
      document.getElementById("b1q1").checked ||
      document.getElementById("b2q1").checked ||
      document.getElementById("b3q1").checked
    )
  ) {
    alert("il faut choisir un choix dans question 1");
    return false;
  }
  if (
    !(
      document.getElementById("b1q2").checked ||
      document.getElementById("b2q2").checked ||
      document.getElementById("b3q2").checked
    )
  ) {
    alert("il faut choisir un choix dans question 2");
    return false;
  }
  if (
    !(
      document.getElementById("b1q3").checked ||
      document.getElementById("b2q3").checked ||
      document.getElementById("b3q3").checked
    )
  ) {
    alert("il faut choisir un choix dans question 3");
    return false;
  }

  return true; // Form submission is allowed if all checks pass
}

function verif(ch) {
  var i = 0;
  while (
    i < ch.length &&
    (("a" <= ch.charAt(i) && ch.charAt(i) <= "z") ||
      ("1" <= ch.charAt(i) && ch.charAt(i) <= "9"))
  ) {
    i++;
  }
  return i === ch.length && i >= 3;
}

function verifemail(e) {
  var n = e.length;
  var a = e.indexOf("@");
  var j = e.indexOf(".");
  var ch1 = e.substring(0, a);
  var ch2 = e.substring(a + 1, j);
  var ch3 = e.substring(j + 1, n);
  var i = 0;
  var test = false;
  if (verif(ch1) && verif(ch2)) {
    test = true;
  }
  return test && 2 <= ch3.length && ch3.length <= 4;
}

function mdp(mp) {
  var s1 = 0;
  var s2 = 0;
  var s3 = 0;
  for (var i = 0; i < mp.length; i++) {
    if ("A" <= mp.charAt(i) && mp.charAt(i) <= "Z") {
      s1++;
    } else if ("1" <= mp.charAt(i) && mp.charAt(i) <= "9") {
      s2++;
    } else if ("a" <= mp.charAt(i) && mp.charAt(i) <= "z") {
      s3++;
    }
  }
  return s1 >= 1 && s2 >= 2 && s3 >= 1 && mp.length === 6;
}
