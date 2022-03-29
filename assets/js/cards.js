console.log("start card creating......")
// select table div
const table = document.getElementById('card_table');
const sale = document.getElementById('sale');
const bought = document.getElementById('bought');
const sold =  document.getElementById('sold');
const balance = document.getElementById("Balance");
//console.log(table);

//admin data reports
var all_user = [];
var all_sold_items = [];


// user data
var sale_item_list = [];
var sold_item_list = [];
var bought_item_list = [];

var is_me = 0;
var me_id ='';
var user_info = '';
var counts;
var file;
function Loading(f, id){
   // alert(id);
    is_me=f;
    me_id = id;
    if(is_me){
    Load_bought(me_id);
    Load_sold(me_id);
    }
    Load_sale(me_id);
    Load_user_info(me_id);
   // get_counts();
}

function create_card(itemmm){
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
    if(itemmm['seller_id']==me_id)
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
    if(sale.className == 'nav-link active show' && is_me) {
        icons.append(buy2);
        if(itemmm['seller_id'] == me_id)
        icons.append(buy3);
    }
    else if(!is_me){
        icons.append(buy1);
        icons.append(buy4);
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

function switch_tabs(value)
{
    document.getElementById("side").style.display = "block";
    var report ;
    if(me_id == '1' && is_me){
        report = document.getElementById('report');
        report.className = 'nav-link';
    }
    if(value == 2){
        
        sale.className = 'nav-link';
        if(is_me){
        sold.className = 'nav-link';
        bought.className = 'nav-link active show';
        }
        table.innerHTML = '';
        bought_item_list.forEach(create_card);

    }else if(value == 1){
        sale.className = 'nav-link active show';
        if(is_me){
        sold.className = 'nav-link';
        bought.className = 'nav-link';
        }
        table.innerHTML = '';
        
        sale_item_list.forEach(create_card);

    }else if(value == 3){
        sale.className = 'nav-link';
        if(is_me){
        sold.className = 'nav-link active show';
        bought.className = 'nav-link';
        }
        table.innerHTML = '';
        sold_item_list.forEach(create_card);
    }
    else if(value == 4){
        document.getElementById("side").style.display = "none";
        report.className = 'nav-link active show';
        sale.className = 'nav-link';
        if(is_me){
        sold.className = 'nav-link';
        bought.className = 'nav-link';

        }
        table.innerHTML = '';
        show_reports();
        // file = document.getElementById('file');
        // file.addEventListener('change',(event)=>{
        //     var reader = new FileReader();
        //     reader.readAsArrayBuffer(event.target.files[0]);
        //     reader.onload = function (event) {
        //         var data = new Uint8Array(reader.result);
        //         var workbook = XLSX.read(data,{typre:'array'});
        
        //         var sheetname = workbook.SheetNames;
        //         var sheetdata = XLSX.utils.sheet_to_json(workbook.Sheets[sheetname[0]],{header:1} );
        //         if(sheetdata.length > 0){

        //         }
        //     }
        // });
        //sold_item_list.forEach(create_card);
    }

    
}
async function ff(f){
    var res = await fetch('../reports/'+f+'.csv');
    const rawd = await res.text();
    console.log(rawd);

    let arrayOne =rawd.split('\n');
    console.log(arrayOne[0]);
    let header = arrayOne[0].split(',');
    let noRow = arrayOne.length;
    let nocol = header.length;
    let jsonData = [];
    let i = 0;
    let j = 0; 

    var table_out = '<br><table class ="table table-striped table-bordered">';
    for(var row = 0; row<noRow-1 ; row++){
        table_out+= '<tr>';
        let r_data = arrayOne[row].split(',');
        for (let cel = 0; cel < nocol; cel++) {
            table_out+= '<td>'+ r_data[cel] + '</td>';
            
        }
        table_out+= '</tr>';
    }

    table_out += '</table>';
    document.getElementById('excel_data').innerHTML=table_out;


}
function gen_report(report){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //alert("report Generated");
            ff(report);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=report"+ "&report=" + report);
}

function show_reports(){
    
table.innerHTML='<div class="container">\
<div class="row">\
    <div class="col-4">\
        <button class="btn btn-default" style="background:grey; color:white" onclick="gen_report(\'center\')">user</button>\
    </div>\
    <div class="col-4">\
        <button class="btn btn-default" style="background:grey; color:white" onclick="gen_report(\'north\')">north</button>\
    </div>\
    <div class="col-4">\
        <button class="btn btn-default" style="background:grey; color:white" onclick="gen_report(\'south\')">south</button>\
    </div>\
    </div>\
</div>\
<div id = "excel_data" ><br></div> ';


    // const report_table = document.createElement('table');
    // report_table.className = 'table';
    // const thead = document.createElement('thead');
    // const tr = document.createElement('tr');
    // const th = document.createElement('th');
    // th.scope='col';
    // th.innerText='#';
    // tr.append(th);
    // const th1 = document.createElement('th');
    // th1.scope='col';
    // th1.innerText='first';
    // tr.append(th1);
    // const th2 = document.createElement('th');
    // th2.scope='col';
    // th2.innerText='last';
    // tr.append(th2);
    // thead.append(tr);
    // report_table.append(thead);
    // const tbody = document.createElement('tbody');

    // array.forEach(element => {
        
    // });


    // for (let index = 0; index < 3; index++) {
    //     const tr = document.createElement('tr');
    //     for (let index = 0; index < 4; index++) {
    //         const th = document.createElement('th');
    //         th.scope='row';
    //         th.innerText='sam';
    //         tr.append(th);
    //     }
    //     report_table.append(tr);
    // } 
    // table.append(report_table);


//     table.innerHTML = '<table class="table">\
//     <thead>\
//       <tr>\
//         <th scope="col">#</th>\
//         <th scope="col">First</th>\
//         <th scope="col">Last</th>\
//         <th scope="col">Handle</th>\
//       </tr>\
//     </thead>\
//     <tbody>\
//       <tr>\
//         <th scope="row">1</th>\
//         <td>Mark</td>\
//         <td>Otto</td>\
//         <td>@mdo</td>\
//       </tr>\
//       <tr>\
//         <th scope="row">2</th>\
//         <td>Jacob</td>\
//         <td>Thornton</td>\
//         <td>@fat</td>\
//       </tr>\
//       <tr>\
//         <th scope="row">3</th>\
//         <td colspan="2">Larry the Bird</td>\
//         <td>@twitter</td>\
//       </tr>\
//     </tbody>\
//   </table>';
}





// Loading data
function Load_sale(id){
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
            switch_tabs(1);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=sale_items"+"&id="+id);
}
function Load_sold(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //location.reload();
            //var res = JSON.parse(xmlhttp.response);
            //alert( res['name']);
            sold_item_list = JSON.parse(xmlhttp.response);
            console.log("res");
            //alert(item_list[0]['name']);
            //switch_tabs(1);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=sold_items"+ "&id="+id);
}
function Load_bought(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //location.reload();
            //var res = JSON.parse(xmlhttp.response);
            //alert( res['name']);
            bought_item_list = JSON.parse(xmlhttp.response);
            console.log("res");
            //alert(item_list[0]['name']);
            //switch_tabs(1);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=bought_items"+ "&id=" + id);
}
function Load_user_info(id){
   // console.log(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //location.reload();
            //var res = JSON.parse(xmlhttp.response);
            //alert( res['name']);
            console.log(xmlhttp.response);
            user_info = JSON.parse(xmlhttp.response);
            get_counts();
            var Name = document.getElementById("user_name");
            Name.innerText = user_info['f_name'] + " " + user_info['l_name'];
            var store = document.getElementById("store_name");
            store.innerText = user_info['store_name'];
            var age = document.getElementById("age");
            age.innerText = user_info['age'];
            var region = document.getElementById("region");
            region.innerText = user_info['region'];
            console.log("nooooo " +user_info['phone_num']);
            console.log("yaaaaa " +user_info['region']);
            var phone = document.getElementById("phone");
            phone.innerText = user_info['phone_num'];
            var email = document.getElementById("email");
            email.innerText= user_info['email'];
            if(is_me){
                var balance = document.getElementById("balance");
                balance.innerText= "Balance : $" + user_info['balance'];
            }

        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=user_info"+"&id=" + id);
}
// change data
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
            //Load_sale(id);
            location.reload();
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=delete_item"+"&id="+id);
} 
function buy_item(id){
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
    xmlhttp.send("op=buy_item"+ "&item_id=" + id);
}
function rechargeBalance(){
    var amount =balance.value;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //loca
            location.reload();
            //alert("Balance added " + amount);
        }
    };
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=recharge_balance" + "&amount=" + amount );

}
function promote_item(item_id){

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

function get_counts(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //location.reload();
            console.log(xmlhttp.response);
            counts = JSON.parse(xmlhttp.response);
            document.getElementById('count_sold').innerText = counts['sold'];
            document.getElementById('count_sale').innerText = counts['sale'];
            document.getElementById('count_bought').innerText = counts['owned'];
            // bought_item_list = JSON.parse(xmlhttp.response);
            // console.log("res");
            //alert(item_list[0]['name']);
            //switch_tabs(1);
        }
    };
   // printf("posting..");
    xmlhttp.open("POST", "../request_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("op=count"+ "&id=" + user_info['id'] + "&region=" + user_info['region']);
}

