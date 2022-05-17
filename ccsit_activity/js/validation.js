
function validate_contact(){
    
    var user = document.SignUp.username.value;
    var Fn = document.SignUp.Fn.value;
    var Ln = document.SignUp.Ln.value;
    var id = document.SignUp.id.value;
    var email = document.SignUp.Em.value;
    var pwd = document.SignUp.pwd.value;
    var magor = document.SignUp.magor.value;
    var level = document.SignUp.level.value;
    
    
    var uname=document.getElementById("user");
    var fname=document.getElementById("fname");
    var lname=document.getElementById("lname");
    var uid=document.getElementById("id");
    var eemail=document.getElementById("email");
    var upwd=document.getElementById("epwd");
    var mag=document.getElementById("mr");
    var L=document.getElementById("lv");
    
    
    var valid=true;
    
    if(user == "")
    {
        valid=false;
        
        uname.setAttribute("style","visibility: visible");
    }
    else
        {
            uname.setAttribute("style","visibility: hidden");
        }
    if(Fn == "")
    {
        valid=false;
        
        fname.setAttribute("style","visibility: visible");
    }
    else
        {
            fname.setAttribute("style","visibility: hidden");
        }
    
    if(Ln == "")
    {
        valid=false;
        lname.setAttribute("style","visibility: visible");        
    }
    else
        {
            lname.setAttribute("style","visibility: hidden");
        }
    
    
    if(id == "")
    {
        valid=false;
        uid.setAttribute("style","visibility: visible");
    }
    else
        {
            uid.setAttribute("style","visibility: hidden");
        }
        
    if(email == "")
    {
        valid=false;
        eemail.setAttribute("style","visibility: visible");
    }
    else
        {
            eemail.setAttribute("style","visibility: hidden");
        }
    if(pwd == "")
    {
        valid=false;
        upwd.setAttribute("style","visibility: visible");
    }
    else
        {
            upwd.setAttribute("style","visibility: hidden");
        }
    
    if(magor == "")
    {
        valid=false;
        mag.setAttribute("style","visibility: visible");
    }
    else
        {
            mag.setAttribute("style","visibility: hidden");
        }
    
    if(level == "")
    {
        valid=false;
        L.setAttribute("style","visibility: visible");
    }
    else
        {
            L.setAttribute("style","visibility: hidden");
        }

    if(valid)
        {
            return true;
        }
    else
        {
            return false;
        }
}

function validate_login(){
    
    var uid = document.login.uid.value;
    var pwd = document.login.pwd.value;
    
    var ename=document.getElementById("ename");
    var epwd=document.getElementById("epwd");
    
    var valid=true;
     if(uid == "")
    {
        valid=false;
        ename.setAttribute("style","visibility: visible");
        //ename.style.visibility = "visible";        
    }
    else
    {
            ename.setAttribute("style","visibility: hidden");
            //ename.style.visibility = "hidden";
    }
    
    if(pwd == "")
    {
        valid=false;
        epwd.setAttribute("style","visibility: visible");
    }
    else
    {
            epwd.setAttribute("style","visibility: hidden");
    }
    if(valid)
    {
            return true;
    }
    else
    {
            return false;
    }
}

function validate_clubs(){
    
    var name = document.CreateClub.Name.value;
    var about = document.CreateClub.about.value;
    
   
    var ename=document.getElementById("name");
    var ab=document.getElementById("About");
    
    var valid=true;
     if(name == "")
    {
        valid=false;
        ename.setAttribute("style","visibility: visible");
        //ename.style.visibility = "visible";        
    }
    else
    {
            ename.setAttribute("style","visibility: hidden");
            //ename.style.visibility = "hidden";
    }
    if(about == "")
    {
        valid=false;
        ab.setAttribute("style","visibility: visible");
        //ename.style.visibility = "visible";        
    }
    else
    {
            ab.setAttribute("style","visibility: hidden");
            //ename.style.visibility = "hidden";
    }
    if(valid)
    {
            return true;
    }
    else
    {
            return false;
    }
}


function openTab(evt, tabName) {
    
  var i, tabcontent, tablinks;
  
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}


function validate_poster(){
    
   
    var title = document.post.title.value;
    var des = document.post.des.value;
    var place = document.post.Place.value;
    var time = document.post.time.value;
    var date = document.post.date.value;
    var edate = document.post.edate.value;
    
    
    var uname=document.getElementById("Ptitle");
    var fname=document.getElementById("Pdes");
    var lname=document.getElementById("Place");
    var uid=document.getElementById("time");
    var eemail=document.getElementById("Sdate");
    var upwd=document.getElementById("Edate");

    
    
    var valid=true;
    
    if(title == "")
    {
        valid=false;
        
        uname.setAttribute("style","visibility: visible");
    }
    else
        {
            uname.setAttribute("style","visibility: hidden");
        }
    if(des == "")
    {
        valid=false;
        
        fname.setAttribute("style","visibility: visible");
    }
    else
        {
            fname.setAttribute("style","visibility: hidden");
        }
    
    if(place == "")
    {
        valid=false;
        lname.setAttribute("style","visibility: visible");        
    }
    else
        {
            lname.setAttribute("style","visibility: hidden");
        }
    
    
    if(time == "")
    {
        valid=false;
        uid.setAttribute("style","visibility: visible");
    }
    else
        {
            uid.setAttribute("style","visibility: hidden");
        }
        
    if(date == "")
    {
        valid=false;
        eemail.setAttribute("style","visibility: visible");
    }
    else
        {
            eemail.setAttribute("style","visibility: hidden");
        }
    if(edate == "")
    {
        valid=false;
        upwd.setAttribute("style","visibility: visible");
    }
    else
        {
            upwd.setAttribute("style","visibility: hidden");
        }

    if(valid)
        {
            return true;
        }
    else
        {
            return false;
        }
}

function validate_news(){
    
    var no = document.news.title.value;
    var title = document.news.detail.value;
    var des = document.news.date.value;
    
    var uname=document.getElementById("Ntitle");
    var fname=document.getElementById("det");
    var lname=document.getElementById("Ndate");
   
    
    
    var valid=true;
    
    if(no == "")
    {
        valid=false;
        
        uname.setAttribute("style","visibility: visible");
    }
    else
        {
            uname.setAttribute("style","visibility: hidden");
        }
    if(title == "")
    {
        valid=false;
        
        fname.setAttribute("style","visibility: visible");
    }
    else
        {
            fname.setAttribute("style","visibility: hidden");
        }
    
    if(des == "")
    {
        valid=false;
        lname.setAttribute("style","visibility: visible");        
    }
    else
        {
            lname.setAttribute("style","visibility: hidden");
        }
 

    if(valid)
        {
            return true;
        }
    else
        {
            return false;
        }
}

function validate_support(){
    var en = document.support.email.value;
    var sub = document.support.sub.value;
    var des = document.support.des.value;
    
    var email=document.getElementById("em");
    var s=document.getElementById("sub");
    var d=document.getElementById("des");
    
    var valid=true;
     if(en == "")
    {
        valid=false;
        email.setAttribute("style","visibility: visible");
        //ename.style.visibility = "visible";        
    }
    else
    {
            email.setAttribute("style","visibility: hidden");
            //ename.style.visibility = "hidden";
    }
    
    if(sub == "")
    {
        valid=false;
        s.setAttribute("style","visibility: visible");
    }
    else
    {
            s.setAttribute("style","visibility: hidden");
    }
    if(des == "")
    {
        valid=false;
        d.setAttribute("style","visibility: visible");
    }
    else
    {
        d.setAttribute("style","visibility: hidden");
    }
    
    if(valid)
    {
            return true;
    }
    else
    {
            return false;
    }
}


function validate_MClubs(){
    
    var name = document.MCreateClub.EName.value;
    var about = document.MCreateClub.about.value;
    var Lead = document.MCreateClub.lead.value;
    
   var lead=document.getElementById("lead");
    var ename=document.getElementById("name");
    var ab=document.getElementById("About");
    
    var valid=true;
     if(name == "")
    {
        valid=false;
        ename.setAttribute("style","visibility: visible");
        //ename.style.visibility = "visible";        
    }
    else
    {
            ename.setAttribute("style","visibility: hidden");
            //ename.style.visibility = "hidden";
    }
    if(about == "")
    {
        valid=false;
        ab.setAttribute("style","visibility: visible");
        //ename.style.visibility = "visible";        
    }
    else
    {
            ab.setAttribute("style","visibility: hidden");
            //ename.style.visibility = "hidden";
    }
    
    if(Lead == "")
    {
        valid=false;
        lead.setAttribute("style","visibility: visible");
        //ename.style.visibility = "visible";        
    }
    else
    {
            lead.setAttribute("style","visibility: hidden");
            //ename.style.visibility = "hidden";
    }
    
    if(valid)
    {
            return true;
    }
    else
    {
            return false;
    }
}


