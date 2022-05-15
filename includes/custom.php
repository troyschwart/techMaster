<!-- Custom wow Scripts -->
<script type="text/javascript">
	//new WOW().init();
	var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
    },
    scrollContainer: null 
  }
);
wow.init();
</script>
<!-- MAIN SCRIPT -->
<script>
$(function(){
//****************REGISTER USER PAGE**********************
    //REGISTER FORM
		$('#reg_btn').click(function(){
			$.ajax({
              url:"register_form",
              method:"POST",
              data:$('#regForm').serialize(),
              success:function(d){
              	$("#success_msg").fadeIn('slow');
                $("#success_msg").html(d);
                /*if(d=="0"){
                    // Swal.fire({'The email or phone number you use is already used by another staff','','warning'});
                    swal('The email or phone number you use is already used by another staff','','warning');
                }
                else if(d=='1'){

                }*/
                setTimeout(function(){
                   $('#success_msg').fadeOut('slow');
                 },10000);
                //$('#regForm')[0].reset();
              }   
          });
		});
    //CONFIRM PASSWORD
    $('#Cpassword').keyup(function(){
        var password=$('#password').val();
        var Cpassword=$('#Cpassword').val();
        if(password===Cpassword){
          $('#message').fadeIn('slow');
          $('#message').html("<span class='text-success'>Password matched !!!</span>");
          setTimeout(function(){
             $('#message').fadeOut('slow');
           },10000);
        }
        else{
          $('#message').fadeIn('slow');
          $('#message').html("<span class='text-danger'>Password do not matched !!!</span>");
        }
      });

    //UPDATING ADD USER POPUP
      $(document).ready(function(){
        var id=$('#input_id').val();
        if(id=='ed'){
           $('#addUser').modal('show');
        }
      });

//****************PROFILE PAGE**********************
    //PROFILE UPDATE
      $('#btn_profile').click(function(){
        var fd=new FormData();
        var userID=$('#userID').val();
        var fname=$('#input_first').val();
        var lName=$('#input_last').val();
        var username=$('#input_username').val();
        var phone=$('#input_phone').val();
        var input_city=$('#input_city').val();
        var input_country=$('#input_country').val();
        var input_address=$('#input_address').val();
        var about_me=$('#about_me').val();
        var files=$('#input_file')[0].files[0];
        fd.append('imagefile',files);
        fd.append('userID',userID);
        fd.append('input_first',fname);
        fd.append('input_last',lName);
        fd.append('input_username',username);
        fd.append('input_phone',phone);
        fd.append('input_city',input_city);
        fd.append('input_country',input_country);
        fd.append('input_address',input_address);
        fd.append('about_me',about_me);
        $.ajax({
          url:'profile_update',
          type:'POST',
          data:fd,
          contentType:false,
          processData:false,
          success:function(response){
                //$('#img').attr('src',response);
                //$('.preview_img').show();
                $("#success_msg").fadeIn('slow');
                $("#success_msg").html(response);
                setTimeout(function(){
                   $('#success_msg').fadeOut('slow');
                 },10000);
          }
        });
        /*$.post('profile_update',{fd,input_first:fname},function(data){
          $("#success_msg").html(data);
        });*/
        });

      //UPDATING PASSWORD
      $('#con_pass').keyup(function(){
        var password_c=$('#password_c').val();
        var con_pass=$('#con_pass').val();
        if(password_c===con_pass){
          $('#message').fadeIn('slow');
          $('#message').html("<span class='text-success'>Password matched !!!</span>");
          setTimeout(function(){
             $('#message').fadeOut('slow');
           },10000);
        }
        else{
          $('#message').fadeIn('slow');
          $('#message').html("<span class='text-danger'>Password do not matched !!!</span>");
        }
      });

//***************************SECRETARY PAGE ************************//
    //COPY TRANSIRE 
    $('#input_bill').keyup(function(){
        var copy=$('#input_bill').val();
        $('#input_bill_copy').val(copy);
     });

    //INSERT TRANSIRE MANIFEST
    $('#btn_trans').click(function(){
      $.ajax({
          url:"insert_transire",
          method:"POST",
          data:$('#form_transire').serialize(),
          success:function(d){
            $("#success_msg").fadeIn('slow');
            $("#success_msg").html(d);
            setTimeout(function(){
               $('#success_msg').fadeOut('slow');
             },10000);
          }   
      });
    });
    //EXPENSES
    /*$('#input_amount').keyup(function(){
        var num=$('#input_amount').val();
        const f=new Intl.NumberFormat('en');
        var newNum=f.format(Number(num).toFixed(2));
        $('#input_amount').val(newNum);
    });*/

    //GENERATING THE CONTAINER NUMBER ON TRANSIRE
    $('#plusBtn1').click(function(){
        i++;
        $('#addContainer').append('<div class="form-row mt-3" id='+i+'><input type="text" id="c'+i+'" name="input_container[]" class="form-control text-uppercase col-4" placeholder="Container Number" maxlength="20"><input type="text" id="s'+i+'" name="input_seal[]" class="form-control text-uppercase col-4 ml-5" placeholder="Seal No" maxlength="20"><button type="button" class="btn btn-primary ml-2 btn_remove" id="'+i+'" name="remove">X</button></div>');
         });
    
    //SAVING CONTAINER NUMBER ON TRANSIRE
    $(document).on('click','#trans-upBtn',function(){
        var button_id=$(this).attr("data-id");
        var idNum=$('#idcon'+button_id).val();
        var conNum=$('#'+button_id).val();
        var sealNum=$('#sn'+button_id).val();
         $.ajax({
          url:"containerSeal",
          method:"POST",
          data:{idNum:idNum,conNum:conNum,sealNum:sealNum},
          success:function(d){
            $('#success_msg').html(d);
          }
        });
    });
//**************** ENQUIRY MESSAGE PAGE **********************
    //GETTING THE ID ON MESSAGE CLICK
    $(document).on('click','.msgID',function(){
        var button_id=$(this).attr("id");
        $("#msgID1").val(button_id);
        $('.message').fadeOut('slow');
        $.ajax({
          url:"fetch_message",
          method:"POST",
          data:$('#get_message').serialize(),
          success:function(d){
            $('.message1').html(d);
            $('.message1').fadeIn('slow');
          }
        });
    });
    //ENABLING REPLYS ON MESSAGES & REPLYING QUERY
    $(document).on('click','#reply_btn',function(){
        var txt1=$('#msgID1').val();
        $('#msgID1').val(txt1);
        //$('#msgID2').val(txt1);
        $.ajax({
          url:"fetch_message",
          method:"POST",
          data:$('#get_message').serialize(),
          success:function(d){
            $('.message1').html(d);
            $('.message2').fadeIn('slow');
          }
        });
    });
    
    $(document).on('click','#reply',function(){
        $('#msgID2').val("reply");
        $.ajax({
          url:"fetch_message",
          method:"POST",
          data:$('#get_message').serialize(),
          success:function(d){
            $('.message1').html(d);
            $('.message2').fadeIn('slow');
          }
        });
    });

//****************SHIPPING MANAGER & RELEASING OFFICER PAGE ******************//

    /*$('#bl_release').change(function(){
        var status=$('#bl_release').val();
        if(status=="choose"){
            $('#file_r').fadeOut('slow');
            $('#comment_area').fadeOut('slow');
        }
        else if(status=="Released"){
            $('#file_r').fadeIn('slow');
            $('#comment_area').fadeOut('slow');
        }
        else{
            $('#file_r').fadeOut('slow');
            $('#comment_area').fadeIn('slow');
        }
    });
*/
    /*//GETTING BL NUMBERS ON LINKS
    $(document).on('click','.getBL',function(){
        var button_id=$(this).attr("id");
        var conNo=$("#cons_no"+button_id).val();
        var b_id=$("#b"+button_id).val();
        $("#bl_id").val(b_id);
        $("#bl_no").val(button_id);
        //$("#cont_no").val(conNo);
        $('#bl_modal').modal('show');
    })*/

    //GENERATING THE CONTAINER NUMBER
      var i=1;
      $('#plusBtn').click(function(){
        i++;
        $('#addContainer').append('<div class="form-row mt-3" id='+i+'><input type="text" id="c'+i+'" name="containerNo[]" class="form-control text-uppercase col-md-6" placeholder="Container Number" maxlength="20"><button type="button" class="btn btn-primary ml-2 btn_remove" id="'+i+'" name="remove">X</button></div>');
         });

      //REMOVING THE CONTAINER FIELD
        $(document).on('click','.btn_remove',function(){
            var button_id=$(this).attr("id");
            $("#"+button_id).remove();
        });

        //SAVING CONTAINER NUMBER
        $(document).on('click','#upBtn',function(){
            var button_id=$(this).attr("data-id");
            var idNum=$('#idcon'+button_id).val();
            var conNum=$('#'+button_id).val();
             $.ajax({
              url:"updateContainer",
              method:"POST",
              data:{idNum:idNum,conNum:conNum},
              //data:'idNum='+idNum 'conNum='+conNum,
              success:function(d){
                $('#success_msg').html(d);
              }
            });
        });

        //SEARCHING FOR A CONTAINER
        $('#search_bl').click(function(){
            $('#ex').fadeOut('slow');
            $('.ex').fadeOut('slow');
        });
        $('#search_btn_bl').click(function(){
            var searchBL=$('#search_bl').val();
            $.ajax({
              url:"search_container",
              method:"POST",
              data:{searchBL:searchBL},
              success:function(d){
                $('#success_').html(d);
              }
            });
        })

        //CALCULATING THE INVOICES
        $(document).on('keyup','.cal-inv',function(){
            var button_id=$(this).attr("id");
            var valueNum=$('#'+button_id).val();
            var valueNum1=valueNum.replace(/,/g,'');
            $('#'+button_id+'1').val(valueNum1);
        });
        $(document).on('mousemove','',function(){
          var amt1=$('#bl_amount1').val();
          var amt2=$('#bl_amt1').val();
          var tot=Number(amt1)+Number(amt2);
          const f=new Intl.NumberFormat('en');
          var newTot=f.format((tot).toFixed(2));
          $('#g_total').val(newTot);
      });

    // TRANSACTION PAGE FOR INVOICES //
      //GETTING BL ID
      $(document).on('click','#bl-id',function(e){
        var button_id=$(this).attr("value");
        $('#bl_modal').modal('show');
        var uid=$('#uid'+button_id).val();
        var bn=$('#bn'+button_id).val();
        var cn=$('#cn'+button_id).val();
        var inNo=$('#inNo'+button_id).val();
        var inAm=$('#inAm'+button_id).val();
        var dinv=$('#dinv'+button_id).val();
        var damt=$('#damt'+button_id).val();
        var conDep=$('#conDep'+button_id).val();
        $('#uid').val(uid);
        $('#bl_bill').val(bn);
        $('#conID').val(cn);
        $('#bl_import').val(inNo);
        $('#bl_amount').val(inAm);
        $('#bl_dent').val(dinv);
        $('#bl_amt').val(damt);
        $('#conDep').val(conDep);
        $('#rl_btn').hide();
        $('#btn_update_bl').fadeIn();
        $('#tid').fadeOut();
        $('#tiud').fadeIn();
        e.preventDafault();
    });

//****************ACCOUNTANT PAGE *****************************************//

      //GENERATING THE INPUTS
      $('#costID').keyup(function(){
        var costID=$('#costID').val();
        if(costID==0 | costID==""){
            $('#success_msg1').fadeOut('slow');
        }
        else{
            $.ajax({
              url:"generate-landing",
              method:"POST",
              data:$('#form_landing').serialize(),
              success:function(d){
                $('#success_msg1').html(d);
                $('#success_msg1').fadeIn('slow');
              }
            });
        }
      });
      //ADDING INPUT WITH ADD BUTTON
      $('#add_cost').click(function(){
            var costID=$('#costID').val();
            var newcostID=Number(costID)+1;
            $('#costID').val(newcostID);
            $.ajax({
              url:"generate-landing",
              method:"POST",
              data:$('#form_landing').serialize(),
              success:function(d){
                $('#success_msg1').html(d);
                $('#success_msg1').fadeIn('slow');
              }
            });
      });
      //SUBTRACTING INPUT WITH MINUS BUTTON
      $('#minus_cost').click(function(){
            var costID=$('#costID').val();
            var newcostID=Number(costID)-1;
            $('#costID').val(newcostID);
            if(newcostID<=0 | newcostID==""){
                $('#success_msg1').fadeOut('slow');
                $('#costID').val("");
            }
            else{
                $.ajax({
                  url:"generate-landing",
                  method:"POST",
                  data:$('#form_landing').serialize(),
                  success:function(d){
                    $('#success_msg1').html(d);
                    $('#success_msg1').fadeIn('slow');
                  }
                });
            }
      });
      //SUMMING THE AMOUNT ON LANDING COST
      $(document).on('keyup','.amt',function(){
            var button_id=$(this).attr("id");
            var costID=$('#costID').val();
            var j=0;
            for(var i=1;i<=costID;i++){
                var amounts=$('#amount'+i).val();
                var amounts=amounts.replace(/,/g,'');
                j=Number(amounts)+Number(j);
                $('#land_total').val(j);
                const f=new Intl.NumberFormat('en');
                var newTot=f.format((j).toFixed(2));
                $('#tot').html(newTot);
            }
      });
      //SAVING LAND COST
      $('#btn_land').click(function(){
        $.ajax({
              url:"insert_landCost",
              method:"POST",
              data:$('#form_landing').serialize(),
              success:function(d){
                $('#success_msg1').html(d);
                $('#success_msg1').fadeIn('slow');
              }
            });
      });

      //FETCHING ID TO INPUT BOX ON COST BL
      $(document).on('click','.blID',function(e){
          var button_id=$(this).attr("value");
          $('#land_bl1').val(button_id);
      });
      //EDITING ON COST BL
      $(document).on('click','#updateID',function(e){
          var button_id=$(this).attr("value");
           //$("#id"+button_id).slideToggle();
           //$("#bl"+button_id).slideToggle();
           $("#s"+button_id).slideToggle();
           $("#e"+button_id).slideToggle();
           $("#d"+button_id).slideToggle();
           $("#a"+button_id).slideToggle();
           //$("#id-"+button_id).slideToggle();
           //$("#bl-"+button_id).slideToggle();
           $("#s-"+button_id).slideToggle();
           $("#e-"+button_id).slideToggle();
           $("#d-"+button_id).slideToggle();
           $("#a-"+button_id).slideToggle();
           $("#p"+button_id).slideToggle();
           $("#update-btn"+button_id).slideToggle();
           $("#print_edit"+button_id).slideToggle();
           $("#"+button_id).slideToggle();
           $(this).fadeOut();
      }); 

    //CALCULATING CUSTOMER ACCOUNT PAYMENT//

      // SET 1 //$("form").trigger("reset");
     
      $('#credit').keyup(function(){
          var amt=$('#amt_cha').val();
          var amt=amt.replace(/,/g,'');
          var credit=$('#credit').val();
          var credit=credit.replace(/,/g,'');
          var bal=Number(amt)-Number(credit);
          $('#bal').val(bal);
      });
      $('#credits').keyup(function(){
          var amt=$('#amt_chas').val();
          var amt=amt.replace(/,/g,'');
          var credit=$('#credits').val();
          var credit=credit.replace(/,/g,'');
          var prevbal=$('#prevbal').val();
          var prevbal=prevbal.replace(/,/g,'');
          var bal=Number(prevbal)+Number(amt)-Number(credit);
          $('#bal').val(bal);
      });

    // SEARCHING CUSTOMER NAME USING SEARCH BOX
    $("#search_text").keyup(function(){
        $('#cus-search').fadeOut();
        $.ajax({
              url:"search_custnames",
              method:"POST",
              data:$('#form_cus').serialize(),
              success:function(d){
                $('#cus-search1').html(d);
              }
            });
        /*if(searchbox==""){
            /*document.getElementById('search_text').style.background='#000';*
            swal('Please enter a customer name in the search box','','error');
        }
        else{
            $.ajax({
              url:"search_custnames",
              method:"POST",
              data:$('#form_customer').serialize(),
              success:function(d){
                if(d=="0"){
                    swal('No customer with such name exist','','warning');
                }
                else{
                    var searchName=$('#search_text').val();
                    $('#custName').val(searchName);
                    $("#custID").val(d);
                }
              }
            });
          }*/
    });

    //ADD INVEST
    $(document).on('keyup','.add-invest',function(){
        var button_id=$(this).attr("id");
        var valueNum=$('#'+button_id).val();
        var valueNum1=valueNum.replace(/,/g,'');
        $('#'+button_id+'1').val(valueNum1);
    });

    $(document).on('mousemove','',function(){
        var adv=$('#input_advice1').val();
        var cond=$('#input_con1').val();
        var ship=$('#input_ship1').val();
        var term=$('#input_term1').val();
        var tran=$('#input_transp1').val();
        var paar=$('#input_paar1').val();
        var cpc=$('#input_cpc1').val();
        var duty=$('#input_duty1').val();
        var settle=$('#input_settle1').val();
        var naf=$('#input_naf1').val();
        var son=$('#input_son1').val();
        var tot=Number(adv)+Number(cond)+Number(ship)+Number(term)+Number(tran)+Number(paar)+Number(cpc)+Number(duty)+Number(settle)+Number(naf)+Number(son);
        const f=new Intl.NumberFormat('en');
        var newTot=f.format((tot).toFixed(2));
        $('#input_total').val(newTot);
    });

    //GETTING STAFF NAME 
    $('#account_query').change(function(){
      var acc=$('#account_query').val();
      if(acc=="choose"){
        swal('Please choose Account Type','','warning');
        $('#account_name').html("<option>Choose Name</option>");
        $("#staff_n").fadeOut('slow');
      }
      else{
        $.ajax({
              url:"search-staff",
              method:"POST",
              data:$(this).serialize(),
              success:function(d){
                $("#staff_n").fadeIn('slow');
                $('#account_name').html(d);
              }
            });
          }
    });
    //SUBMITTING THE QUERY
    $('#query_btn').click(function(){
        $.ajax({
              url:"send-query",
              method:"POST",
              data:$("#query-form").serialize(),
              success:function(d){
                $('#success_mo').html(d);
              }
            });
    });
    //SUBMITTING THE APPROVAL
    $('#appro_btn').click(function(){
        $.ajax({
              url:"send-approval",
              method:"POST",
              data:$("#appro-form").serialize(),
              success:function(d){
                $('#success_mo').html(d);
              }
            });
    });
    $('#search-prog').keyup(function(){
          $.ajax({
          url:"bl_search",
          method:"POST",
          data:$(this).serialize(),
          success:function(d){
                $("#tab").fadeOut('slow');
                $("#tab2").fadeIn('slow');
                $("#show_tab").html(d);
          }
        });
    });
    //SEARCH BY NAME INPUT
    /*$("#custName").keyup(function(){
        $.ajax({
          url:"search_custnames",
          method:"POST",
          data:$('#form_customer').serialize(),
          success:function(d){
                $("#custID").val(d);
          }
        });
    });*/
//**************** TRANSPORTER PAGE **********************//
    //SAVING CONTAINER NUMBER
        $(document).on('click','#upBtn_tp',function(){
            var button_id=$(this).attr("data-id");
            var idNum=$('#idcon'+button_id).val();
            var conNum=$('#'+button_id).val();
             $.ajax({
              url:"updateContainer_tp",
              method:"POST",
              data:{idNum:idNum,conNum:conNum},
              success:function(d){
                $('#success_msg').html(d);
              }
            });
        }); 
        $('#tp_ret').change(function(){
            var ret=$('#tp_ret').val();
            if(ret=="tpd"){
                $('#tp_return').fadeIn('fast');
                $('#release_file').fadeOut('fast');
            }
            else if(ret=="tpu"){
              $('#release_file').fadeIn('fast');
              $('#tp_return').fadeOut('fast');
            }
            else{
              $('#tp_return').fadeOut('fast');
              $('#release_file').fadeOut('fast');
            }
        });

        //CALCULATING THE COST ON CONTAINER
        $('#paid').keyup(function(){
            var amount=$('#amount').val();
            var valueAmt=amount.replace(/,/g,'');
            var paid=$('#paid').val();
            var valuepaid=paid.replace(/,/g,'');
            var balance=valueAmt-valuepaid;
            $('#bal').val(balance);
            var bal=$('#bal').val();
            if(0>bal){
                swal("Amount deposited cannot be greater than Amount charged!","", "error");
                $('#paid').val('');
                $('#bal').val('');
            }
            else if(paid==''){
              $('#bal').val('');
            }
        });
        //CALCULATING THE COST ON CONTAINER2
        $('#paid2').keyup(function(){
            var prevamount=$('#prevbal').val();
            var valueAmt=prevamount.replace(/,/g,'');
            var paid=$('#paid2').val();
            var valuepaid=paid.replace(/,/g,'');
            var balance=valueAmt-valuepaid;
            $('#bal').val(balance);
            var bal=$('#bal').val();
            if(0>bal){
                swal("Amount deposited cannot be greater than previous balance!","", "error");
                $('#paid2').val('');
                $('#bal').val('');
            }
            else if(paid==''){
              $('#bal').val('');
            }
            else if(bal==0){
              swal("Good Job!","Balance is completed", "success");
            }
            if(prevamount==0){
              swal("Balance is complete!","This customer is not oweing any more", "warning");
            }
        });
//****************NAV MENU PAGE **********************//
    $('#second-item').click(function(){
        $("#second-list").slideToggle();
    });
    $('#second-item-1').click(function(){
        $("#second-list-1").slideToggle();
    });

//****************GENERAL SCRIPTS**********************//
    $('#jobs_btn').click(function(){
        var searchbox=$('#search-txt').val();
        if(searchbox==""){
            swal('Please enter a BL Number in the search box','','error');
        }
        else{
            $.ajax({
              url:"search_bl",
              method:"POST",
              data:$('#form-jobs').serialize(),
              success:function(d){
                  $('#search_jobs').modal('hide');
                  $('#show-jobs').modal('show');
                  $('#job_msg').html(d);
              }
            });
          }
    });
    //GENERAL DELETE CONFIRMATION
    $(document).on('click','.del_btn',function(){
        var button_id=$(this).attr("id");
        $('#delID').val(button_id);
    });
    //AUTO HIDE ALERT
    $(document).ready(function(){
      setTimeout(function(){
         $('.alert').fadeOut('slow');
       },15000);
    });
    //CHECKING USER UPDATE POPUP
      $(document).ready(function(){
        var uuid=$('#uuid').val();
        if(uuid=='no' | uuid==""){
           //$('#modal_update').modal('show');
        }
        $('.toast').toast('show');
      });
      //WELCOMING ON LOGIN PAGE POPUP
      /*$(document).ready(function(){
        var uuid=$('#uuil').val();
        if(uuil=='login'){
          $('#modal_prints').modal('show');
        }
      });*/
    //DATES PICKERS
    $("#date_bl_from").datepicker();
    $("#date_bl_to").datepicker();
    $("#dateInvoice").datepicker();
    $("#dueDate").datepicker();
    $("#date_from").datepicker();
    $("#date_to").datepicker();
    $("#from_date").datepicker(); 
    $("#to_date").datepicker();
    //NUMBER DIVIDER
    //$("#input_amount").divide();

    //TIMER
    var mytime=setInterval(myTimer,1000);
    function myTimer(){
        var d=new Date();
        document.getElementById("timer") .innerHTML=d.toLocaleTimeString();
    }
    

    //ALERTING QUERY MESSAGES
    $(document).ready(function(){
        var msg=$('#msg').val();
        var msgid=$('#msgid').val();
        var uid=$('#uid').val();
        if(msgid==uid){
            if(msg==1){
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
              });
              Toast.fire({
                type: 'success',
                title: "You have "+msg+" new query message <span class='fa fa-envelope text-success'></span>"
              });
            }
            else if(!(msg<=0)){
              const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 10000
            });
            Toast.fire({
              type: 'success',
              title: "You have "+msg+" new query messages <span class='fa fa-envelope text-success'></span>"
            });
          }
        }

        //FOR APPROVAL MESSAGES
        var appid=$('#appid').val();
        var appName=$('#appName').val();
        if(appName=='Manager' | appName=='Administrator'){
          if(appid==1){
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 10000
                });
                Toast.fire({
                  type: 'success',
                  title: "You have "+appid+" approval message sent to you <span class='fa fa-envelope text-success'></span>"
                });
              }
              else if(!(appid<=0)){
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
              });
              Toast.fire({
                type: 'success',
                title: "You have "+appid+" approval messages sent to you <span class='fa fa-envelope text-success'></span>"
              });
              /*Swal.fire({
                position:'top-end',
                height:10,
                width:600,
                title:"You have "+appid+" approval messages sent to you <span class='fa fa-envelope text-success'></span>",
                showConfirmButton:false,
                timer:15000
              })*/
            }
        }
    });
/********************* BREVERAGES SCRIPT ***********************************************/
        //INSERTING INTO OUTLET TABLE 
        $('#submit_outlet').click(function(event){
          event.preventDefault();
          $.ajax({
            url:"insert_outlet.php",
            type:"POST",
            data:$('#form-outlet').serialize(),
            success:function(d){
            $('#success_msg').html(d);
              $('#form-outlet')[0].reset();
            }
          });
        });
        //INSERTING INTO STOCK TABLE 
        $('#submit_stock').click(function(){
          event.preventDefault();
          $.ajax({
            url:"insert stock.php",
            type:"POST",
            data:$('#form-stock').serialize(),
            success:function(d){
            $('#success_msg').html(d);
              $('#form-stock')[0].reset();
            }
          });
        });
        //AUTO GENERATING INVOICE NUMBER 
        $('#outlet').change(function(){
            var outletInvoice=$('#outlet').val();
            if(outletInvoice=="choose"){
              swal('Please choose an outlet','','warning');
              /*$('#account_name').html("<option>Choose Name</option>");
              $("#staff_n").fadeOut('slow');*/
            }
            else{
              $.ajax({
                url:"auto_invoiceNo",
                method:"POST",
                data:$(this).serialize(),
                success:function(d){
                  //$("#staff_n").fadeIn('slow');
                  $('#invoiceNo').val(d);
                }
              });
            }
        });
/********************* END BREVERAGES **************************************************/
    /*window.addEventListener('load',function()  {
        setInterval(functionhere,1000);
    });*/
})//END OPENING FUNCTION

$(document).ready(function() {
    $('#example').DataTable({responsive: true});
    $('#example1').DataTable({responsive: true});
    $('#example2').DataTable({responsive: true});
    $('#example3').DataTable({responsive: true});
});

    //$('#input_weight1').divide();
    //ADDING KGS TO WEIGHT
    /*$('#input_weight').keyup(function(){
        var copy=$('#input_weight').val();
        //const f=new Intl.NumberFormat('en',{style:'currency',currency:'JAP'});
        const f=new Intl.NumberFormat('en');
        var newcopy=f.format(Number(copy).toFixed(2));
        $('#input_weight1').val(newcopy);
     });*/
    
    //SWAL SCRIPTS
     /*const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 10000
  });

  Toast.fire({
    type: 'success',
    title: "You have a new notification message <span class='fa fa-check-circle'></span>"
  });*/

  /*Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})*/

/*preConfirm:function(){
  return new Promise(function(){
      $.ajax({
          url:'update_transact',
          type:'POST',
          data:'delete='+id,
          dataType:'json'
        });
      .done(function(response){
        swal('Updated',response.message,response.status);
        updateTable();
      });
      .fail(function(){
        swal('Ooops...','Failed to update','error');
        updateTable();
      });
  });
},allowOutSideClick:false
Swal.fire({
              title: 'Are you sure!',
              text: 'Do you want to update that information ?',
              type: 'warning',
              showCancelButton:true,
              confirmButtonColor:'#007bff',
              confirmButtonColor:'#dc3545',
              confirmButtonText: 'Update',
              showLoaderOnConfirm:true
            })
//PRINT
      $('#btn_land_print').click(function(){
        var body=document.getElementById('body').innerHTML;
        alert('Hello');
        var print_tab=document.getElementById('print_tab').innerHTML;
        document.getElementById('body').innerHTML=print_tab;
        javascript:window.print();
      });
Swal.fire({
              title: '<strong>HTML <u>example</u></strong>',
              type: 'info',
              html:
                'You can use <b>bold text</b>, ' +
                '<a href=//github.com>links</a> ' +
                'and other HTML tags',
              showCloseButton: true,
              showCancelButton: true,
              focusConfirm: false,
              confirmButtonText:
                '<i class=fa fa-thumbs-up></i> Great!',
              confirmButtonAriaLabel: 'Thumbs up, great!',
              cancelButtonText:
                '<i class=fa fa-thumbs-down></i>',
              cancelButtonAriaLabel: 'Thumbs down',
            })

Swal.fire({
                icon:'warning',
                title:'You have $numRow container that has not been returned',
                text:'Do you want to view them',
                footer:'<a href=#>View</a>',
                showDenyButton:true,
                showCancelButton:true,
                confirmButtonText:'View Containers',
                denyButtonText:'Don't view,

              }).then((result)=>{
                if(result.isConfirmed){

                }
                else if(result.isDenied){

                }
              })

  let timerInterval
        Swal.fire({
          title: 'Auto close alert!',
          html: 'I will close in <b></b> milliseconds.',
          timer: 2000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft()
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
          }
        })
*/
</script>
