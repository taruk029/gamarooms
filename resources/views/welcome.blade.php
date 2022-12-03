<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>OutplacementHeros</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('HomeImages/Favicon.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166949554-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-166949554-1');
  </script>
  <style type="text/css">
        * 
        {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
          font-family: 'Cabin', sans-serif;
          border: 0px none;
        }
        /*Navigation bar CSS*/
        .nav
        {
          background: #038cfc;
          width: 100%;
          height: 600px;
          position: relative;
          z-index: 1;
          width: 100%;
          min-height: 70px;
          background-position: bottom center;
          background-size: cover;
        }
        .logo img
        {
          margin-top: 1%;
          float: left;
          width: 240px;
          height: 100px;
          margin-right: 50px;
          margin-left: 1%;
        }
        .nav > .nav-header 
        {
          display: inline;
        }
        .nav > .nav-btn 
        {
          display: none;
        }
        .nav > .nav-links 
        {
          display: inline;
          margin-top: 2%;
          margin-right: 4%;
          background-color: transparent;
          float: right;
          font-weight: 600;
          font-size: 19px;
        }
        .nav > .nav-links > a 
        {
          display: inline-block;
          padding: 10px 10px 10px 10px;
          margin-right: 10px;
          text-decoration: none;
          color: white;
          background-color: rgba(0,0,0,0);
          border-radius: 5px;
        }
        .nav > .nav-links > .active
        {
          border-bottom: 2px solid #f51653;
          border-bottom-right-radius: 0px;
          border-bottom-left-radius: 0px;
        }
        .nav > .nav-links > a:hover 
        {
          border-bottom: 2px solid #f51653;
          border-bottom-right-radius: 0px;
          border-bottom-left-radius: 0px;
        }
        .nav > #nav-check 
        {
          display: none;
        }
        @media (max-width:900px) 
        {
          .nav
          {
            max-height: 550px;
          }
          .nav > .nav-btn 
          {
            display: inline-block;
            position: absolute;
            right: 0px;
            top: 0px;
          }
          .nav > .nav-btn > label 
          {
            display: inline-block;
            width: 50px;
            height: 50px;
            padding: 13px;
            right: 0px;
            top: 0px;
          }
          .nav > .nav-btn > label:hover,.nav  #nav-check:checked ~ .nav-btn > label 
          {
            background-color: rgba(0, 0, 0, 0);
          }
          .nav > .nav-btn > label > span 
          {
            right: 0;
            display: block;
            width: 30px;
            height: 10px;
            border-top: 4px solid white;
          }
          .nav > .nav-links 
          {
            position: absolute;
            display: inline-block;
            width: 100%;
            background-color: white;
            height: 0px;
            transition: all 0.3s ease-in;
            overflow-y: hidden;
            top: 40px;
            left: 0px;
          }
          .nav > .nav-links > a 
          {
            display: block;
            width: 100%;
            color: black;
          }
          .nav > #nav-check:not(:checked) ~ .nav-links 
          {
            height: 0px;
          }
          .nav > #nav-check:checked ~ .nav-links 
          {
            height: calc(100vh - 50px);
            overflow-y: auto;
          }
          .logo img
          {
            width: 200px;
            height: 70px;
          }
        }
        /*Wave CSS*/
        section .wave
        {
          position: absolute;
          bottom: 0;
          left: 0;
          width: 100%;
          height: 100px;
          background-color: white;
          background: url({{ asset('HomeImages/wave.png') }});
          background-size: 1000px 100px;
        }
        section .wave.wave1
        {
          animation: animate 30s linear infinite;
          z-index: 1000;
          opacity: 1;
          animation-delay: 0s;
          bottom: 0;
        }
        section .wave.wave2
        {
          animation: animate2 15s linear infinite;
          z-index: 999;
          opacity: 0.5;
          animation-delay: -5s;
          bottom: 10px;
        }
        section .wave.wave3
        {
          animation: animate 30s linear infinite;
          z-index: 998;
          opacity: 0.2;
          animation-delay: -2s;
          bottom: 15px;
        }
        section .wave.wave4
        {
          animation: animate2 10s linear infinite;
          z-index: 997;
          opacity: 0.7;
          animation-delay: -5s;
          bottom: 20px;
        }
        @keyframes animate
        {
          0%{ background-position-x: 0;}
          100%{ background-position-x: 1000px; }
        }
        @keyframes animate2
        {
          0%{ background-position-x: 0;}
          100%{ background-position-x: 1000px; }
        }
        /*Heading CSS*/
        .con
        {
          margin-top: 12%;
          margin-bottom: 1%;
        }
        h1
        {
          margin-left: 25%;
          font-size: 75px;
          font-family: cursive;
          color: white;
          font-weight: 600;
        }
        .con1
        {
          margin-bottom: 4%;
        }
        h2
        {
          margin-left: 52%;
          font-size: 25px;
          font-family: cursive;
          color: white;
          font-weight: 600;
        }
        .welcome-heading 
        {
          margin-bottom: 100px;
        }
        .welcome-heading > h3 
        {
          font-size: 300px;
          position: absolute;
          font-weight: 900;
          margin-left: 12px;
          margin-top: -30%;
          z-index: -1;
          color: blue;
          opacity: 0.1;
          -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=10)";
        } 
        /*Login button CSS*/
        .btn1
        {
          border-radius: 30px 5px;
          width: 100px;
          margin-left: 30%;
          color: white;
          font-weight: 550;
          font-size: 25px;
          transition: all 0.3s ease 0s;
        }
        .btn1-lg
        {
          padding: 12px 35px;
        }
        .btn1:hover
        {
          border-radius: 5px 30px;
          background-color: white;
          color: black;
        }
        .pink1
        {
          background-color: #f51653;
        }
        /*Approach CSS*/
        @media only screen and (max-width: 800px) 
        {
          .approach img
          {
            width: 90%;
            height: auto;
            margin-top: 20px;
          }

        }
        /*Cards CSS*/
        .flexbox 
        {
          display: flex;
          flex-direction: row;
          justify-content: space-around;
          width: 100%;
          margin-bottom: 15%;
          flex-wrap: wrap;
        }
        .flexcard 
        {
          display: flex;
          flex-direction: column;
          justify-content: flex-start;
          width: 18%;
          align-items: baseline;
          height: 350px;
          border-radius: 20px;
        }
        .flexcardNumber 
        {
          width: 70%;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 50px;
          margin: 10px 0px;
          border-radius: 0px 50px 50px 0px;
          font-family: 'Cabin', sans-serif;
          color: white;
          text-shadow: 0px 3px 5px black;
          font-weight: 500;
          font-size: 20px;
          position: relative;
        }
        .flexcardTitle 
        {
          font-family: helvetica;
          text-align: left;
          font-size: 25px;
          line-height: 1em;
          color: #3f403e;
          text-align: left;
          font-weight: 600;
        }
        .flexcardNumber:before 
        {
          content: '';
          width: 34px;
          height: 90px;
          position: absolute;
          left: -33px;
          top: 0px;
          border-radius: 50px 0px 0px 50px;
          z-index: -1;
          background: -moz-linear-gradient(bottom, #95B7A2, #038cfc);
        }
        .flexcardNumber:after 
        {
          content: '';
          width: 25px;
          height: 40px;
          position: absolute;
          left: -25px;
          bottom: -40px;
          border-radius: 50px 0px 0px 50px;
          z-index: -1;
        }
        .flex 
        {
          display: flex;
          justify-content: center;
          width: 100%;
          margin: 10px auto;
        }
        .btn
        {
          border-radius: 30px 5px;
          margin-left: 5%;
          color: white;
          font-weight: 550;
          transition: all 0.3s ease 0s;
        }
        .btn-lg
        {
          padding: 10px 22px;
        }
        .btn:hover
        {
          border-radius: 5px 30px;
          color: white;
        }
       
        .blue
        {
          margin-top: 5%;
          margin-left: 60%;
          background: #038cfc;
        }
        @media only screen and (max-width: 767px) 
        {
          .btn
          {
            margin-bottom: 15px;
          }
        }
      
        .flexcardBlue 
        {
          background: rgba(3, 140, 252,0.05);
          box-shadow: 4px 8px 0px #038cfc;
        }
        .flexcardNumberBlue
        {
          background: #c4c4c4;
          background: -webkit-linear-gradient(right, #FCFCFC, #038cfc);
          background: -moz-linear-gradient(right, #FCFCFC, #038cfc);
          background: linear-gradient(to left, #FCFCFC, #038cfc);
          box-shadow: 0px 2px 2px #038cfc;
        }
        .flexcardNumberBlue:before 
        {
          background: #038cfc;
        }
        .flexcardNumberBlue:after 
        {
          background: rgba(3, 140, 252,0.1);
        }
        /* RESPONSİVE */
        @media only screen and (max-width: 800px) 
        {
          .flexcard 
          {
            width: 30%;
            margin-top: 20px;
          }
        }
        @media only screen and (max-width: 500px) 
        {
          .flexcard 
          {
            width: 70%;
          }
        }
        /*Video CSS*/
        video
        {
          width: 800px;
          height: 450px;
        }
        /*Subheadings CSS*/
        .ribbon 
        {
          font-size: 25px !important;
          width: 70%;
          position: relative;
          background: #038cfc;
          color: #fff;
          text-align: center;
          padding: 0.5em 0.5em; 
          max-height: 50px;
          margin: 1em auto 1em;
        }
        .ribbon:before, .ribbon:after 
        {
          content: "";
          position: absolute;
          display: block;
          bottom: -1em;
          border: 1em solid #038cfc;
          z-index: -1;
        }
        .ribbon:before 
        {
          left: -1.5em;
          border-right-width: 1.5em;
          border-left-color: transparent;
        }
        .ribbon:after 
        {
          right: -1.5em;
          border-left-width: 1.5em;
          border-right-color: transparent;
        }
        .ribbon .ribbon-content:before, .ribbon .ribbon-content:after 
        {
          content: "";
          position: absolute;
          display: block;
          border-style: solid;
          border-color: #f51653 transparent transparent transparent;
          bottom: -1em;
        }
        .ribbon .ribbon-content:before 
        {
          left: 0;
          border-width: 1em 0 0 1em;
        }
        .ribbon .ribbon-content:after 
        {
          right: 0;
          border-width: 1em 1em 0 0;
        }
        @media only screen and (max-width: 990px)
        {
          .ribbon{ width: 70%;}
          .ribbon-content{font-size: 17px;}
          .ribbon:before,.ribbon:after 
          {
            border-right-width: 0em;
            border-left-width: 0em;
          }
          .ribbon .ribbon-content:before,.ribbon .ribbon-content:after 
          {
            border-width: 0 0 0 0;
          }
          .ribbon:before, .ribbon:after 
          {
            border: 0em solid #038cfc;
          }
          video
          {
            width: 280px;
            height: 160px;
          }
        }
        @media only screen and (max-width: 767px){.ribbon{ font-size: 20px; }video{width: 280px;height: 160px;}}
        @media only screen and (max-width: 479px){.ribbon{ font-size: 20px; }}
        @media only screen and (max-width: 359px){.ribbon{ font-size: 15px; }}
        /*Team CSS*/
        .our-team{ margin-top: -10%;text-align: center; }
        .our-team .pic
        {
          border-radius: 50%;
          overflow: hidden;
          position: relative;
        }
        .our-team .pic:before,.our-team .pic:after
        {
          content: "";
          width: 100%;
          height: 100%;
          border-radius: 50%;
          border: 8px solid #e6e5e5;
          position: absolute;
          top: 0;
          left: 0;
        }
        .our-team .pic1:after
        {
          border-color: #e5e5e5 #e6e5e5 #e6e5e5 #e5e5e5;
          z-index: 1;
          transform: rotate(-10deg);
          transition: all 0.5s ease 0s;
        }
        .our-team .pic2:after
        {
          border-color: #f51653 #e6e5e5 #e6e5e5 #f51653;
          z-index: 1;
          transform: rotate(-10deg);
          transition: all 0.5s ease 0s;
        }
        .our-team .pic3:after
        {
          border-color: #e7fc03 #e6e5e5 #e6e5e5 #e7fc03;
          z-index: 1;
          transform: rotate(-10deg);
          transition: all 0.5s ease 0s;
        }
        .our-team .pic4:after
        {
          border-color: #e81587 #e6e5e5 #e6e5e5 #e81587;
          z-index: 1;
          transform: rotate(-10deg);
          transition: all 0.5s ease 0s;
        }
        .our-team:hover .pic:after{ border-color: #f51653 #038cfc #038cfc #f51653;}
        .our-team img
        {
          width: 100%;
          height: auto;
        }
        .our-team .title
        {
          font-size: 18px;
          font-weight: bold;
          color: #3f403e;
          padding-bottom: 10px;
          margin: 15px 0 10px 0;
          position: relative;
        }
        .our-team .title:after
        {
          content: "";
          width: 50px;
          height: 2px;
          background: #222;
          margin: 0 auto;
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
        }
        .our-team .post
        {
          display: block;
          font-size: 13px;
          color: #777;
        }
        @media only screen and (max-width: 990px)
        {
          .our-team{ margin-bottom: 60px; }
          .con h1
          {
            font-size: 30px;
            margin-left: 10%;
            margin-bottom: 1%;
            margin-top: 40%;
          }
          .con1 h2
          {
              font-size:15px;
              margin-left:30%;
              margin-bottom:15%;
          }
          .welcome-heading > h3 
          {
            margin-top: -115%;
          } 
          .pink1
          {
            margin-left: 30%;
            font-size: 20px;
          }
        }
        /*Footer CSS*/
        ul 
        {
          margin: 0px;
          padding: 0px;
        }
        .footer-section 
        {
          margin-top: 10%;
          background: #edf0ed;
          position: relative;
        }
        .footer-content 
        {
          position: relative;
          z-index: 2;
        }
        .footer-pattern img 
        {
          position: absolute;
          top: 0;
          left: 0;
          height: 330px;
          background-size: cover;
          background-position: 100% 100%;
        }
        .footer-text p 
        {
          margin-bottom: 14px;
          font-size: 14px;
          color: #3f403e;
          line-height: 28px;
        }
        .footer-social-icon span 
        {
          color: #4f4e4c;
          margin-top: 15%;
          display: block;
          font-size: 20px;
          font-weight: 700;
          font-family: 'Poppins', sans-serif;
          margin-bottom: 20px;
        }
        .footer-social-icon a 
        {
          color: #fff;
          font-size: 16px;
          margin-right: 15px;
          margin-top: 20px;
        }
        .footer-social-icon i 
        {
          height: 40px;
          width: 40px;
          text-align: center;
          line-height: 38px;
          border-radius: 50%;
        }
        .facebook-bg
        {
          background: #3B5998;
        }
        .whatsapp-bg 
        {
          background: green;
        }
        .twitter-bg
        {
          background: #55ACEE;
        }
        .insta-bg
        {
          background: #e0106a;
        }
        .linkedin-bg
        {
          background: #0e76a8;
        }
        .footer-widget-heading h3 
        {
          color: #4f4e4c;
          font-size: 20px;
          font-weight: 600;
          margin-bottom: 40px;
          position: relative;
        }
        .footer-widget-heading h3::before 
        {
          content: "";
          position: absolute;
          left: 0;
          bottom: -15px;
          height: 2px;
          width: 70px;
          background: #038cfc;
        }
        .footer-widget ul li 
        {
          color: #878787;
          font-size: 15px;
          display: inline-block;
          float: left;
          width: 80%;
          margin-bottom: 12px;
        }
        .subscribe-form 
        {
          font-size: 15px;
          position: relative;
          overflow: hidden;
        }
        .subscribe-form input 
        {
          width: 100%;
          padding: 10px 10px;
          background: #f5f3f0;
          border: 1px solid #2E2E2E;
          color: black;
        }
        .subscribe-form button 
        {
          position: absolute;
          right: 0;
          background: #038cfc;
          padding: 13px 20px;
          border: 1px solid #2E2E2E;
          top: 0;
        }
        .subscribe-form button i 
        {
          color: #fff;
          font-size: 22px;
          transform: rotate(-6deg);
        }
        .copyright-area
        {
          margin-top: 7%;
          background: #edf0ed;
        }
        .copyright-text p 
        {
          font-size: 14px;
          color: #878787;
        }
  </style>
</head>
<body>
  <!--Header section-->
  <div class="nav">
    <input type="checkbox" id="nav-check">
    <div class="nav-header">
      <a class="logo" href="/">
        <img src="{{ asset('HomeImages/Logo.jpeg') }}">
      </a>
    </div>
    <div class="nav-btn">
      <label for="nav-check">
        <span></span>
        <span></span>
        <span></span>
      </label>
    </div>
    <div class="nav-links">
      <a class="active" href="/">Home</a>
      <a href="javascript:void(0)">About</a>
      <!-- <a href=" http://careers.changeleaders.in/">Currently hiring</a> -->
      <a href="javascript:void(0)">Volunteer Speaks</a>
      <a href="javascript:void(0)">Contact</a>  </div>
    <div class="con"></div>
    <div class="con1"></div>
    <div class="row">
      <div class="col-md-6"><h2 style="margin-left: 10%">1- You search on popular websites<br> We will find hidden jobs for you</h2></div>
      <div class="col-md-6"><h2 style="margin-left: 10%">2- You focus on exploring your network<br> Let us connect you with unconnected </h2></div>
      <div class="col-md-6"><h2 style="margin-left: 10%">3- You practice interview skills <br> Let us get you Interview coaching </h2></div>
      <div class="col-md-6"><h2 style="margin-left: 10%">4- Job Search Assistance, Networking with employers, Interview preparation<br> Are powerful tools alone, but unstoppable when used together</h2></div>
    </div><br>
    <div class="container">
      <div class="row">
        @if(!Auth::check())
        <a href="{{ url('jobseeker') }}" class="btn1 btn1-lg pink1">Job Seeker Registration</a> 
        @else
         <a href="{{ url('my_jobs') }}" class="btn1 btn1-lg pink1">Go To Jobs</a> 
        @endif

      </div>
    </div>
    <section>
      <div class="wave">
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
      </div>
    </section>
  </div>
  <!--Our approach section-->
  <h1 class="ribbon">
    <strong class="ribbon-content">HOW DOES IT WORK?</strong>
  </h1>
  <div class="approach">
    <center><img src="{{ asset('HomeImages/3.jpeg') }}" alt="Image" width="1000px" height="600px"></center>
  </div>
  <!--Roles section-->
  @if(!Auth::check())
  <h1 class="ribbon" style="margin-top: 5%;margin-bottom: 10%;">
    <strong class="ribbon-content">CHOOSE YOUR ROLE</strong>
  </h1>
  <div class="flexbox">
    <div class="flexcard flexcardBlue">
      <div class="flexcardNumber flexcardNumberBlue"></div>
      <div class="flex flexcardTitle" style="margin-top: 5%;">Recruitment<br></div>
      <div class="flex flexcardTitle" style="margin-left: -4%;">Consultant<br></div>
      <div class="flex flexcardTitle" style="margin-left: -10%;">Offering<br></div>
      <div class="flex flexcardTitle" style="margin-left: -18%;">Jobs</div>
      <div class="flex flexcardText"></div>
      <div class="row">
        <a href="javascript:void(0)" class="btn btn-lg blue">Register</a>
      </div>
    </div>
    <div class="flexcard flexcardBlue">
      <div class="flexcardNumber flexcardNumberBlue"></div>
      <div class="flex flexcardTitle" style="margin-top: 5%;margin-left:-7%">Mentors<br></div>
      <div class="flex flexcardTitle" style="margin-left: -2.5%">Extending<br></div>
      <div class="flex flexcardTitle" style="margin-left: -1.5%">Skill based<br></div>
      <div class="flex flexcardTitle" style="margin-left: -16%">Help</div>
      <div class="flex flexcardText"></div>
      <div class="row">
        <a href="javascript:void(0)" class="btn btn-lg blue">Register</a>
      </div>
    </div>
    <div class="flexcard flexcardBlue">
      <div class="flexcardNumber flexcardNumberBlue"></div>
      <div class="flex flexcardTitle" style="margin-top: 5%; margin-left: -6%">Employers<br></div>
      <div class="flex flexcardTitle" style="margin-left: -16%">Hiring<br></div>
      <div class="flex flexcardTitle" style="margin-left: -12%">Laid-off<br></div>
      <div class="flex flexcardTitle" style="margin-left: -1.5%">Job Seekers</div>
      <div class="flex flexcardText"></div>
      <div class="row">
        <a href="javascript:void(0)" class="btn btn-lg blue">Register</a>
      </div>
    </div>
    <div class="flexcard flexcardBlue">
      <div class="flexcardNumber flexcardNumberBlue"></div>
      <div class="flex flexcardTitle" style="margin-top: 5%; margin-left: -8%">Separating<br></div>
      <div class="flex flexcardTitle" style="margin-left: -8%">Employers<br></div>
      <div class="flex flexcardTitle" style="margin-left: -15%">Offering<br></div>
      <div class="flex flexcardTitle" style="margin-left: 0%">Outplacement</div>
      <div class="flex flexcardText"></div>
      <div class="row">
        <a href="javascript:void(0)" class="btn btn-lg blue">Register</a>
      </div>
    </div>
  </div> 

  @endif


  <!--Video Section-->
  <h1 class="ribbon mt-5" style="margin-bottom: 10%;">
    <strong class="ribbon-content">WHY OutplacementHeros?</strong>
  </h1>
  <center>
    <video id="player" style="margin-bottom: 10%;margin-top: -5%;" poster="{{ asset('HomeImages/3.jpeg') }}" controls>
      <source src="{{ asset('HomeImages/Movie.mp4') }}" type="video/mp4">
    </video>
  </center>
  <!--Our team section-->
  <h1 class="ribbon" style="margin-top: -5%;margin-bottom: 10%;">
    <strong class="ribbon-content">OUR TEAM</strong>
  </h1>
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-6 col-md-offset-1">
        <div class="our-team">
          <div class="pic pic1"><img src="{{ asset('HomeImages/Founder.jpg') }}" alt=""></div>
          <h3 class="title">Roshan Rawat</h3>
          <span class="post">Founder</span>
        </div>
      </div>
      <div class="col-md-2 col-sm-6">
        <div class="our-team">
          <div class="pic pic1"><img src="{{ asset('HomeImages/Pic1.jpeg') }}" alt=""></div>
          <h3 class="title">Shivani Pandey</h3>
          <span class="post">Volunteer Support</span>
        </div>
      </div>
     <!--    <div class="col-md-2 col-sm-6">
       <div class="our-team">
         <div class="pic pic1"><img src="{{ asset('HomeImages/Pic.jpeg') }}" alt=""></div>
           <h3 class="title">Darshana Dutta</h3>
           <span class="post">Hiring Employer<br> Support</span>
         </div>
       </div> -->
        <div class="col-md-2 col-sm-6">
        <div class="our-team">
          <div class="pic pic1"><img src="{{ asset('HomeImages/Pic3.jpeg') }}" alt=""></div>
            <h3 class="title">Shruty Snehal</h3>
            <span class="post">Separating Employer Support</span>
          </div>
        </div>
        <div class="col-md-2 col-sm-6">
        <div class="our-team">
          <div class="pic pic1"><img src="{{ asset('HomeImages/Pic2.jpeg') }}" alt=""></div>
          <h3 class="title">Mavish Saxena</h3>
          <span class="post">Recruitment consultant Support</span>
        </div>
      </div>
      <div class="col-md-2 col-sm-6">
        <div class="our-team">
          <div class="pic pic1"><img src="{{ asset('HomeImages/Pic5.jpeg') }}" alt=""></div>
            <h3 class="title">Megha Nigam</h3>
            <span class="post">Job Seeker Support</span>
          </div>
        </div>
    </div>
  </div>
  <!--Footer Section-->
  <footer class="footer-section">
    <div class="container">
      <div class="footer-content pt-5 pb-5">
        <div class="row">
          <div class="col-xl-4 col-lg-4 mb-50">
            <div class="footer-widget">
              <div class="footer-widget-heading">
                <h3>Follow Us</h3>
              </div>
              <div class="footer-social-icon">
                <a href="https://www.facebook.com/outplacementheros/"><i class="fab fa-facebook-f facebook-bg"></i></a>
                <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                <a href="https://instagram.com/outplacementheros?igshid=ppg4sguw3ieg"><i class="fab fa-instagram insta-bg"></i></a>
                <a href="https://www.linkedin.com/company/outplacementheros"><i class="fab fa-linkedin linkedin-bg"></i></a>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
            <div class="footer-widget">
              <div class="footer-widget-heading">
                <h3>Contact Us</h3>
              </div>
              <ul>
                <li>Email: hello@outplacementheros.org</li>
                <li>Outplacement Heros , 332, 3rd floor, Centrum Plaza, Golf Course Road, Sector 53 Gurgaon 122003</li>
              </ul>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
            <div class="footer-widget">                
              <div class="footer-widget-heading">
                <h3>Subscribe</h3>
              </div>
              <div class="footer-text mb-25">
                <p style="font-size: 15px;">Don’t miss to subscribe to our new feeds, kindly fill your email ID below.</p>
              </div>
              <div class="subscribe-form">
                <form action="https://changeleaders.us18.list-manage.com/subscribe/post?u=e1b860c00f51449ba306e2cba&amp;id=2cc10d102f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                  <div id="mc_embed_signup_scroll">
                    <input type="text" placeholder="Email ID" id="mce-EMAIL" required>
                    <div id=" id="mc-embedded-subscribe">
                      <button><i class="fab fa-telegram-plane" value="Subscribe" type="submit"></i></button>
                    </div>
                  </div>
                  <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                  </div> 
                  <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e1b860c00f51449ba306e2cba_2cc10d102f" tabindex="-1" value=""></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-area">
      <div class="container">
        <div class="row">
          <div class="col-xl-12 col-lg-12 text-center text-lg-center">
            <div class="copyright-text">
              <p>Copyright &copy; OutplacementHeros 2020, All Rights Reserved.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
  <script type='text/javascript'>
    (function($) {
      window.fnames = new Array(); 
      window.ftypes = new Array();
      fnames[0]='EMAIL';
      ftypes[0]='email';
      fnames[1]='FNAME';
      ftypes[1]='text';
      fnames[2]='LNAME';
      ftypes[2]='text';
      fnames[3]='ADDRESS';
      ftypes[3]='address';
      fnames[4]='PHONE';
      ftypes[4]='phone';
      fnames[5]='BIRTHDAY';
      ftypes[5]='birthday';
    }(jQuery));
    var $mcj = jQuery.noConflict(true);
  </script>
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5ecf69868ee2956d73a557e3/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
</body>
</html>