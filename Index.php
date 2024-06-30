<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="this is description of the title write something about your webpage which is show on while some one search and browsing">
    <meta name="keywords" content="white, keywords, about, your, webpage, to, rank, your, website, on, google, search, results">
    <meta name="author" content="about you">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="" type="image/jpg" sizes="32x32">
    <title>CRUD</title>
  </head>
  <body>
      <h1 style="text-align: center;">CRUD</h1><hr>
    <style>
    /*------- Styling--------------------*/

    </style>
    <!----------------------------------------------------------------------------------------------------------------->
    <!--Start Coding-->
    <div class="row mt-1">
        <div class="col-sm-6">
            <div class="container">
                <h1 style="text-align: center;">Add And Update Records</h1>
                <form id="the_form">

                    <input type="hidden" class="form-label" id="record_id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name_id" placeholder="Full Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email_id" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input type="number" class="form-control" name="number" id="number_id" placeholder="Number">
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Add Record" class="btn btn-primary" id="add_btn">
                    </div>
                    <div id="msg"></div>
                </form>
            </div>
        </div>
        <div class="col-sm-6 text-center">
            <div class="container">
                <h1 style="text-align: center;">All Records</h1>
                <table class="table" border="2">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!----------------------------------------------------------------------------------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> <!--Bootstarp.js CDN File With Popper.js CDN File-->
    
    <script>//---JavaScript--------AJAX----------

//------------------------------------------------------------------------------------------------------------------------------------------
        
//Add Record

        document.getElementById("add_btn").addEventListener("click",add_btn_f); //taking control of form submit button
        function add_btn_f(event)
        {
            event.preventDefault();     //it will stop reloading the page button default behavior

            console.log("Test is button working or not");       //this is for testing purpose is function working or not
            
        //it will take value from the form
            let the_record_id = document.getElementById("record_id").value;
            let the_name = document.getElementById("name_id").value;        //name data
            let the_email = document.getElementById("email_id").value;      //email_data
            let the_number = document.getElementById("number_id").value;    //number_data

            console.log(the_name); console.log(the_email); console.log(the_number); //this is for testing is form data fetched or not

        //Creating XMLHTTPRequest Object
            const XHR1 = new XMLHttpRequest();

        //initializing:-  Object_Name.open("Method GET  or  POST", "where do you want to send the data", true)
            XHR1.open("POST","insert.php",true);

        //set Request Header
            XHR1.setRequestHeader("Content-Type", "application/json");

        //Handling Response Server will give you response you have to handle it
            XHR1.onload = ()=>{
                if(XHR1.status === 200)
                {
                    //Response Handling Code
                    //this message from "insert.php" is data successfully saved or not
                    document.getElementById("msg").innerHTML='<div class="alert alert-success" role="alert" >'+XHR1.responseText+'</div>';
                    document.getElementById("the_form").reset();

                    show_data();    //this is function call "THIS FUNCTION IS FROM SHOW RECORDS TO SHOW LIVE RECORD ADDED IN RECORDS"
                    
                    console.log(XHR1.responseText);
                }
                else
                {
                    console.log("Error");
                }
            };
            //first you have to convert it into javascript object
            const js_obj = {going_id:the_record_id, name:the_name, email:the_email, number:the_number};   //it is javascript object
            console.log(js_obj);

            //to send data into the server you have to convert your javascript object to "JSON String"
            const the_data = JSON.stringify(js_obj);    //it will convert your javascript object to "JSON String"
            console.log(the_data);

            //Now Send The Data
            XHR1.send(the_data);  //data sended. "this data is goto insert.php file"
        }

//---------------------------------------------------------------------------------------------------------------------------------------------------
    
//Show Records

        let the_tbody = document.getElementById("tbody");
        function show_data()
        {
            tbody.innerHTML = "";
            const XHR2 = new XMLHttpRequest();
            XHR2.open("GET", "Records.php", true);
            XHR2.responseType = "json";     // 2 it will convert your JSON file into Javascript Object
            XHR2.onload = ()=>{
                if(XHR2.status === 200)
                {
                    console.log(XHR2.response);     // 1 Now It is JSON But you Have to Convert it into JSON To Javascript Object
                    if(XHR2.response)
                    {
                        x = XHR2.response;
                    }
                    else
                    {
                        x = "";
                    }
                    for(i=0; i<x.length; i++)
                    {
                        tbody.innerHTML+="<tr><td>"+
                                        x[i].id+
                                        "</td><td>"+
                                        x[i].name+
                                        "</td><td>"+
                                        x[i].email+
                                        "</td><td>"+
                                        x[i].number+
                        "</td><td><button class='btn btn-success btn-sm btn-edit' data-the_id="+x[i].id+">Edit</button> <button class='btn btn-danger btn-sm btn-delete' data-the_id="+x[i].id+">Delete</button></td></tr>";
                    }
                }
                else
                {
                    console.log("Error");
                }

                delete_f();     //this function belong from delete department
                edit_f();       //this function belong from edit department

            };
            XHR2.send();
        }

        show_data();    //this is function call

//---------------------------------------------------------------------------------------------------------------------------------------------------
    
//Delete Records

        function delete_f()
        {
            let x = document.getElementsByClassName("btn-delete");
            for(let i=0; i<x.length; i++)
            {
                x[i].addEventListener("click", function(){
                    id = x[i].getAttribute("data-the_id");
                    const XHR3 = new XMLHttpRequest();
                    XHR3.open("POST", "Delete.php", true);
                    XHR3.setRequestHeader("Content-Type", "application/json");
                    XHR3.onload = () =>{
                        if(XHR3.status === 200)
                        {
                            console.log(XHR3.response);
                            document.getElementById("msg").innerHTML='<div class="alert alert-danger" role="alert" >'+XHR3.responseText+'</div>';

                            show_data();    //this is function call "THIS FUNCTION IS FROM SHOW RECORDS TO SHOW LIVE RECORD ADDED IN RECORDS"
                        }
                        else
                        {
                            console.log("Error");
                        }
                    }

                    //first you have to convert it into javascript object
                    const js_obj = {going_id:id};   //it is javascript object "id will go to delete page" 
                    console.log(js_obj);

                    //to send data into the server you have to convert your javascript object to "JSON String"
                    const the_data = JSON.stringify(js_obj);    //it will convert your javascript object to "JSON String"
                    console.log(the_data);

                    //Now Send The Data
                    XHR3.send(the_data);  //data sended. "this data is goto insert.php file"
                });
            }
        }


//---------------------------------------------------------------------------------------------------------------------------------------------------
    
//Edit Records

        function edit_f()
        {
            let x = document.getElementsByClassName("btn-edit");

                let the_record_id = document.getElementById("record_id");
                let the_name = document.getElementById("name_id");        //name data
                let the_email = document.getElementById("email_id");      //email_data
                let the_number = document.getElementById("number_id");    //number_data

            for(let i=0; i<x.length; i++)
            {
                x[i].addEventListener("click", function(){
                    id = x[i].getAttribute("data-the_id");
                    const XHR4 = new XMLHttpRequest();
                    XHR4.open("POST", "Edit.php", true);
                    XHR4.responseType = "json";
                    XHR4.setRequestHeader("Content-Type", "application/json");
                    XHR4.onload = () =>{
                        if(XHR4.status === 200)
                        {
                            console.log(XHR4.response);
                            
                            a = XHR4.response;

                            the_record_id.value = a.id;
                            the_name.value = a.name;
                            the_email.value = a.email;
                            the_number.value = a.number;
                        }
                        else
                        {
                            console.log("Error");
                        }
                    }

                    //first you have to convert it into javascript object
                    const js_obj = {going_id:id};   //it is javascript object "id will go to delete page" 
                    console.log(js_obj);

                    //to send data into the server you have to convert your javascript object to "JSON String"
                    const the_data = JSON.stringify(js_obj);    //it will convert your javascript object to "JSON String"
                    console.log(the_data);

                    //Now Send The Data
                    XHR4.send(the_data);  //data sended. "this data is goto insert.php file"
                });
            }
        }


    </script>

  </body>
</html>