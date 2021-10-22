
//Wyświetla form gdy zaznaczony
function openaccount()
{
	if(!$('#usercheckbox').prop('checked'))
    {
        $('.new_account').hide();
        $('#login').attr('required', false);
        $('#password').attr('required', false);
        $('#confirm_password').attr('required', false);
    }
    else
    {
        $('.new_account').show();
        $('#login').attr('required', true);
        $('#password').attr('required', true);
        $('#confirm_password').attr('required', true);
    }
}

function openAddress()
{
    if(!$('#different_address_checkbox').prop('checked'))
    {
        $('.different_address').hide();
        $('#new_country').attr('required', false);
        $('#new_adress').attr('required', false);
        $('#new_post_code').attr('required', false);        
        $('#new_city').attr('required', false);
        $('#new_phone').attr('required', false);
    }
    else
    {
        $('.different_address').show();
        $('#new_country').attr('required', true);
        $('#new_adress').attr('required', true);
        $('#new_post_code').attr('required', true);        
        $('#new_city').attr('required', true);
        $('#new_phone').attr('required', true);
    }
}

//metody płatności z zależności od opcji dostawy + zmiana ceny
function deliveryradio()
{
    if($('#dpd2').prop('checked') == true)
    {
        $('#payu_block').hide();
        $('#on_delivery_block').show();
        $('#transfer_block').hide();

        $('#transfer').prop('checked',false);
        $('#payu').prop('checked',false);

        let newtotal = total - discountjs + md3;
        $("#count_delivery").html(newtotal.toFixed(2)+" zł");
        let newtotal2 = total - discountjs;
        $("#price_rabat").html(newtotal2.toFixed(2)+" zł");
        $("#price_delivery").html(md3.toFixed(2)+" zł");
        $('#price_delivery_block').show();
    }

    if($('#inpost').prop('checked') == true)
    {
        $('#payu_block').show();
        $('#on_delivery_block').hide();
        $('#transfer_block').show();

        $('#on_delivery').prop('checked',false);

        let newtotal = total - discountjs + md1;
        $("#count_delivery").html(newtotal.toFixed(2)+" zł");
        let newtotal2 = total - discountjs;
        $("#price_rabat").html(newtotal2.toFixed(2)+" zł");
        $("#price_delivery").html(md1.toFixed(2)+" zł");
        $('#price_delivery_block').show();
    }

    if($('#dpd').prop('checked') == true)
    {
        $('#payu_block').show();
        $('#on_delivery_block').hide();
        $('#transfer_block').show();

        $('#on_delivery').prop('checked',false);

        let newtotal = total - discountjs + md2;
        $("#count_delivery").html(newtotal.toFixed(2)+" zł");
        let newtotal2 = total - discountjs;
        $("#price_rabat").html(newtotal2.toFixed(2)+" zł");
        $("#price_delivery").html(md2.toFixed(2)+" zł");
        $('#price_delivery_block').show();
    }

    if($('#dpd2').prop('checked') == false && $('#inpost').prop('checked') == false && $('#dpd').prop('checked') == false)
    {
        $('#price_delivery_block').hide();
        let newtotal = total - discountjs;
        $("#count_delivery").html(newtotal.toFixed(2)+" zł");
        let newtotal2 = total - discountjs;
        $("#price_rabat").html(newtotal2.toFixed(2)+" zł");
    }
}

//Jquery + Ajax
//Walidacja formularza
$('#form1').submit(function(event){
    event.preventDefault();

    var login = $("#login").val();
    var password = $("#password").val();
    var confirmpassword = $("#confirm_password").val();
    var firstname = $("#name").val();
    var lastname = $("#lastname").val();
    var country = $("#country").val();
    var address = $("#adress").val();
    var post_code = $("#post_code").val();
    var city = $("#city").val();
    var phone = $("#phone").val();
    var delivery = $("input[name='delivery']:checked").val();
    var payment = $("input[name='payment']:checked").val();
    var comment = $("#comment").val();
    var newsletter = $("input[name='newsletter']:checked").val();
    var new_account = $("input[name='new_account']:checked").val();
    var different_address = $("input[name='different_address']:checked").val();
    var new_country = $("#new_country").val();
    var new_address = $("#new_adress").val();
    var new_post_code = $("#new_post_code").val();
    var new_city = $("#new_city").val();
    var new_phone = $("#new_phone").val();
    var recaptcha=grecaptcha.getResponse();

    if (newsletter == undefined)
    {
        newsletter = "2";
    }

    if (new_account == undefined)
    {
        new_account = "2";
    }

    if (different_address == undefined)
    {
        different_address = "2";
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
            new_account:new_account,
            different_address:different_address,
            login:login,
            password:password,
            confirmpassword:confirmpassword,
            firstname:firstname,
            lastname:lastname,
            country:country,
            address:address,
            post_code:post_code,
            city:city,
            phone:phone,
            delivery:delivery,
            payment:payment,
            comment:comment,
            price:price,
            newsletter:newsletter,
            recaptcha:recaptcha,
            new_country:new_country,
            new_address:new_address,
            new_post_code:new_post_code,
            new_city:new_city,
            new_phone:new_phone
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
            if(discountjs!=0){
                $('#price_rabat_block').show();
            }
            deliveryradio();
            
        }
    });
}