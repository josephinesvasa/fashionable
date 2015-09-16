function show(id){

    console.log('hello');
    var form = $(id).serialize();

    console.log(id);


    $.ajax({
        type: 'GET',
        url: '/fashionable/user/GetThisPicture',
        data: {id_data:id},

        dataType:'JSON',
        success: function (data) {
            var hej=JSON.parse(data);

            if(hej!==false) {

                var hello=true;

                for (var i=0; i < hej.length; i++){

                    var a =document.createElement("a");
                    var productPic = document.createElement("img");
                    productPic.src = '/fashionable/views/image/'+hej[i];
                    productPic.className="product_pictures";
                    //listPic.className='div_pictures';
                    productPic.id = "inspo_pic" + i;
                    a.href='/fashionable/user/GetAllProducts';


                    a.appendChild(productPic);

                    document.getElementById("lala").appendChild(a);
                    //document.getElementById("overlay");
                    $('#lala').fadeIn(2000);
                    $('.product_pictures').fadeIn(1000);
                    $('#overlay').fadeIn(1000);

                }

            }
            else{
                alert("error");
            }


        }

    });
    $('#lala').empty();
}


function hidethis(){
    $('#lala').fadeOut(1000);

    $('#overlay').fadeOut(1000);
}

