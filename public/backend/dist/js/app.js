let debt = document.querySelector(".debt");
let interest=document.querySelector(".interest");
let deposit=document.querySelector(".deposit")
//interest.value=debt.value*.0025*100;
//console.log(interest.value);
document.querySelector(".debt").onkeyup = function () {
    interest.value=debt.value*.0025*100;
    deposit.value=debt.value-interest.value;
}