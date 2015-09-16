function ShowImg(id){
    console.log('hello');
    var form = $(id).serialize();

    console.log(id);

    $.ajax({
        type: 'GET',
        url: '/fashionable/user/GetProductImage',
        data: {prod_data: id},

        dataType: 'JSON',
        success: function (data) {

            var hej = JSON.parse(data);

            if (hej !== false) {

                var hello = true;

                for (var i = 0; i < hej.length; i++) {
                    var ul = document.createElement("ul");
                    var listPic = document.createElement("li");
                    var productPic = document.createElement("img");
                    productPic.src = '/fashionable/views/image/' + hej[i];
                    productPic.className = "this_pic";
                    productPic.id='product_id_picture';
                    ul.className = "pics";

                    ul.appendChild(listPic);
                    listPic.appendChild(productPic);


                    document.getElementById("showProduct").appendChild(ul);

                }
            }
        }
    }
    );


    $.ajax({
        type: 'GET',
        url: '/fashionable/user/showInfo',
        data: {info_data: id},


        dataType: 'JSON',
        success: function (data) {

            var info = JSON.parse(data);

            if (info !== false) {

                var hello = true;

                var div=document.createElement("div");
                div.id='p_div';
                for (var i = 0; i < info.length; i++) {
                    var info_p = document.createElement("p");
                    info_p.innerHTML = info[i];
                    info_p.className = "this_info";
                    div.appendChild(info_p)

                    document.getElementById("showProduct").appendChild(div);


                    $('#showProduct').fadeIn(2000);

                    $('#prod_overlay').fadeIn(1000);


                }
            }
            else {
                alert("error");
            }


        }


    });


    $('#showProduct').empty();
    $('#p_div').empty();
}

function closeProduct(){
    $('#prod_overlay').fadeOut(500);
    $('#showProduct').fadeOut(2000);





}

