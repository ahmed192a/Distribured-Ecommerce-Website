console.log("start card creating......")

// select table div
const table = document.getElementById('card_table');

//console.log(table);

var list= [0,1,2,3,4,5];
var listn= [0,1,2];

var sale_item_list = [];

var user_id = 0;

var categ = 'all';
var q= '';
function Loading( id){
    // alert(id);
    user_id = id;
    Load_sale();
 }
 function Loadingg( id, d){
    // alert(id);
    categ='q';
    q = d;
    user_id = id;
    Load_sale();
 }

function filter_item(i){
    switch (i) {
        case 1:
            categ = 'all';
        break;
        case 2:
            categ = 'hat';
        break;
        case 3:
            categ = 'shirt';
        break;
        case 4:
            categ = 'shoe';
        break;

        default:
            categ = 'all';
            break;
    }
    Load_sale();
}
function create_card(itemmm){
    if(categ != 'all'){
        if(categ =='q'){
            if(!(q==itemmm['name'] || q == itemmm['description'])){
                return;
            }
        }
        else if(categ != itemmm['category_type']){
            return ;
        }
    }

    const card = document.createElement('div');
    card.className = "col-lg-4 col-md-8 col-sm-12";
    const item = document.createElement('div');
    item.className = "card product_item";
    const item_body = document.createElement('div');
    item_body.className = "body";

    const img_c = document.createElement('div');
    img_c.className = "cp_img";
    const img = document.createElement('img');
    img.src = "https://bootdey.com/img/Content/avatar/avatar2.png";
    img.alt = "Product";
    img.className = "img-fluid";
    const icons = document.createElement('div');
    icons.className = "hover";
    const buy1 = document.createElement('a');
    //buy1.href = "javascript:void(0);";
    buy1.setAttribute('onclick',"buy_item('"+itemmm['id']+"')") ;
    buy1.className ="btn btn-primary btn-sm waves-effect";
    const link = document.createElement('i');
    link.className ="zmdi zmdi-shopping-cart";

    const buy2 = document.createElement('button');
    if(itemmm['seller_id']==user_id)
    buy2.setAttribute('onclick',"delete_item('"+itemmm['id']+"')") ;
    else
    buy2.setAttribute('onclick',"remove_item('"+itemmm['id']+"')") ;
   // buy2.onclick = "";
    buy2.className ="btn btn-primary btn-sm waves-effect";
    const link2 = document.createElement('i');
    link2.className = "zmdi zmdi-delete";

    const buy3 = document.createElement('button');
    //buy3.href = "edit_item.html";
    buy3.setAttribute('onclick',"edit_item('"+itemmm['id']+"')") ;
    buy3.className ="btn btn-primary btn-sm waves-effect";
    const link3 = document.createElement('i');
    link3.className = "zmdi zmdi-edit";
   
    

    const buy4 = document.createElement('button');
    //buy4.href = "javascript:void(0);";
    buy4.setAttribute('onclick',"promote_item('"+itemmm['id']+"')") ;
    buy4.className ="btn btn-primary btn-sm waves-effect";
    const link4 = document.createElement('i');
    link4.className = "zmdi zmdi-plus-circle-o";
    
    buy1.append(link);
    buy2.append(link2);
    buy3.append(link3);
    buy4.append(link4);

//    icons.append(buy1);
    if(user_id != itemmm['seller_id']) {
        icons.append(buy1);
        icons.append(buy4);
    }else{
        icons.append(buy2);
        icons.append(buy3);
    }


    img_c.append(img);
    img_c.append(icons);

    const product_details = document.createElement('div');
    product_details.className = "product_details";
    const name_head = document.createElement('h5');
    const item_link = document.createElement('a');
    item_link.href = "profile.php?id="+itemmm['seller_id'];
    item_link.innerText = itemmm['name'];
    name_head.append(item_link);

    const details = document.createElement('p');
    details.innerText =  "Description : "+itemmm['description'];

    product_details.append(name_head);
    product_details.append(details);

    const list_prices= document.createElement('ul');
    list_prices.className = "product_price list-unstyled";
    const old_price= document.createElement('li');
    old_price.className = "old_price";
    old_price.innerText = '$16.00';
    const new_price= document.createElement('li');
    new_price.className = "new_price";
    new_price.innerText = "$ "+itemmm['price'];

    //list_prices.append(old_price);
    list_prices.append(new_price);
    
    product_details.append(list_prices);


    

    item_body.append(img_c);
    item_body.append(product_details);
    item.append(item_body);
    card.append(item);

    table.append(card);
    //return card;
}

function edit_item(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.href ="edit_item.php";
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=set_edit_item"+"&id="+id);
}

function delete_item(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xmlhttp.response);
            Load_sale(id);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=delete_item"+"&id="+id);
} 













function Load_sale(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //location.reload();
            //var res = JSON.parse(xmlhttp.response);
            //alert( res['name']);
            console.log(xmlhttp.response);
            sale_item_list = JSON.parse(xmlhttp.response);
            console.log("res");
            //alert(sale_item_list[0]['name']);
            //switch_tabs(1);
            table.innerHTML = '';

            sale_item_list.forEach(create_card);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=all_items");
}

function buy_item(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
            //alert(xmlhttp.response)
            // bought_item_list = JSON.parse(xmlhttp.response);
            // console.log("res");
            //alert(item_list[0]['name']);
            //switch_tabs(1);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=buy_item"+ "&item_id=" + id);
}

function promote_item(item_id){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //location.reload();
            // alert(xmlhttp.response)
            // bought_item_list = JSON.parse(xmlhttp.response);
            // console.log("res");
            //alert(item_list[0]['name']);
            //switch_tabs(1);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=promote_item"+ "&item_id=" + item_id);
}
function remove_item(item_id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
            // bought_item_list = JSON.parse(xmlhttp.response);
            // console.log("res");
            //alert(item_list[0]['name']);
            //switch_tabs(1);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=remove_promote_item"+ "&item_id=" + item_id);
}



