//JavaScript
//Wyświetla form gdy checked
function openaccount()
{
	if(!document.getElementById('usercheckbox').checked)
    {
        document.getElementById('newaccount').style.display = "none";
    }
    else
    {
        document.getElementById('newaccount').style.display = "block";
    }
}

//metody płatności z zależności od opcji dostawy + zmiana ceny
function deliveryradio()
{
    if(document.getElementById('md3').checked)
    {
        document.getElementById('divmp1').style.display = "none";
        document.getElementById('divmp2').style.display = "block";
        document.getElementById('divmp3').style.display = "none";

        document.getElementById('mp3').checked = false;
        document.getElementById('mp1').checked = false;

        let newtotal = total - discountjs + md3;
        document.getElementById("countdelivery").innerHTML = newtotal.toFixed(2)+" zł";
        let newtotal2 = total - discountjs;
        document.getElementById("priceend").innerHTML = newtotal2.toFixed(2)+" zł";
    }

    if(document.getElementById('md1').checked)
    {
        document.getElementById('divmp1').style.display = "block";
        document.getElementById('divmp2').style.display = "none";
        document.getElementById('divmp3').style.display = "block";

        document.getElementById('mp2').checked = false;

        let newtotal = total - discountjs + md1;
        document.getElementById("countdelivery").innerHTML = newtotal.toFixed(2)+" zł";
        let newtotal2 = total - discountjs;
        document.getElementById("priceend").innerHTML = newtotal2.toFixed(2)+" zł";
    }

    if(document.getElementById('md2').checked)
    {
        document.getElementById('divmp1').style.display = "block";
        document.getElementById('divmp2').style.display = "none";
        document.getElementById('divmp3').style.display = "block";

        document.getElementById('mp2').checked = false;

        let newtotal = total - discountjs + md2;
        document.getElementById("countdelivery").innerHTML = newtotal.toFixed(2)+" zł";
        let newtotal2 = total - discountjs;
        document.getElementById("priceend").innerHTML = newtotal2.toFixed(2)+" zł";
    }

    if(document.getElementById('md2').checked == false && document.getElementById('md3').checked == false && document.getElementById('md1').checked == false)
    {
        let newtotal = total - discountjs;
        document.getElementById("countdelivery").innerHTML = newtotal.toFixed(2)+" zł";
        let newtotal2 = total - discountjs;
        document.getElementById("priceend").innerHTML = newtotal2.toFixed(2)+" zł";
    }
}

//Jquery + Ajax
//Walidacja formularza
$('#form1').submit(function(event){
    event.preventDefault();

    var login = $("#login").val();
    var password = $("#password").val();
    var confirmpassword = $("#confirmpassword").val();
    var firstname = $("#name").val();
    var lastname = $("#lastname").val();
    var country = $("#country").val();
    var adress = $("#adress").val();
    var post_code = $("#post_code").val();
    var city = $("#city").val();
    var phone = $("#phone").val();
    var delivery = $("input[name='delivery']:checked").val();
    var payment = $("input[name='payment']:checked").val();
    var comment = $("#comment").val();
    var newsletter = $("input[name='newsletter']:checked").val();
    var recaptcha=grecaptcha.getResponse();
   
    if (newsletter == undefined)
    {
        newsletter = "Brak";
    }

    if (comment == "")
    {
        comment = "Brak";
    }

    if (delivery == undefined)
    {
        delivery = " ";
    }

    if (payment == undefined)
    {
        payment = " ";
    }

    var price;

    switch(delivery)
    {
        case '1':price = total-discountjs+10.99;break;
        case '2':price = total-discountjs+18;break;
        case '3':price = total-discountjs+22;break;
        default:price = "";break;
    }

    $.ajax({
        url: "order.php", 
        method: 'post',
        data:{
            login:login,
            password:password,
            confirmpassword:confirmpassword,
            firstname:firstname,
            lastname:lastname,
            country:country,
            adress:adress,
            post_code:post_code,
            city:city,
            phone:phone,
            delivery:delivery,
            payment:payment,
            comment:comment,
            price:price,
            newsletter:newsletter,
            recaptcha:recaptcha
            
        },
        success: function(result){
            $("#feedback").html(result);
        }
    });
});

//Wyświetlanie PopUp z logowaniem
var myModal = document.getElementById('loginpop')
var myInput = document.getElementById('loginpopid')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})

var onloadCallback = function() {
    grecaptcha.render('html_element', {
        'sitekey' : '6Ld5QIccAAAAADM0YHDNc_JFGtWQIYZMWG_LwVa3'
    });
};

//Walidacja kodu rabatowego
function discount()
{
    var discount = $("#discount").val();
    $.ajax({
        url: "discount.php", 
        method: 'post',
        data:{
            discount:discount   
        },
        success: function(result){
            $("#feedback2").html(result);
            deliveryradio();
        }
    });
}