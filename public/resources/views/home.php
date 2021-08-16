<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{@asset('home.css')}}">
  <title>HelpyStack</title>
</head>

<body>
  <header>
    <div class="logo">
      <span>HelpyStack</span>
    </div>

    <nav>
      <a href="#">Learn</a>
      <a href="#">Pricing</a>
      <a href="#">Community</a>
      <a href="#">Blog</a>
    </nav>

    <div class="right-header">
      <button>
        <svg viewBox="0 0 512 512" width="1em" height="1em" class="action-icon">
          <path d="M256 32C132.3 32 32 134.9 32 261.7c0 101.5 64.2 187.5 153.2 217.9 1.4.3 2.6.4 3.8.4 8.3 0 11.5-6.1 11.5-11.4 0-5.5-.2-19.9-.3-39.1-8.4 1.9-15.9 2.7-22.6 2.7-43.1 0-52.9-33.5-52.9-33.5-10.2-26.5-24.9-33.6-24.9-33.6-19.5-13.7-.1-14.1 1.4-14.1h.1c22.5 2 34.3 23.8 34.3 23.8 11.2 19.6 26.2 25.1 39.6 25.1 10.5 0 20-3.4 25.6-6 2-14.8 7.8-24.9 14.2-30.7-49.7-5.8-102-25.5-102-113.5 0-25.1 8.7-45.6 23-61.6-2.3-5.8-10-29.2 2.2-60.8 0 0 1.6-.5 5-.5 8.1 0 26.4 3.1 56.6 24.1 17.9-5.1 37-7.6 56.1-7.7 19 .1 38.2 2.6 56.1 7.7 30.2-21 48.5-24.1 56.6-24.1 3.4 0 5 .5 5 .5 12.2 31.6 4.5 55 2.2 60.8 14.3 16.1 23 36.6 23 61.6 0 88.2-52.4 107.6-102.3 113.3 8 7.1 15.2 21.1 15.2 42.5 0 30.7-.3 55.5-.3 63 0 5.4 3.1 11.5 11.4 11.5 1.2 0 2.6-.1 4-.4C415.9 449.2 480 363.1 480 261.7 480 134.9 379.7 32 256 32z">
          </path>
        </svg>
        <span>Sign In</span>
      </button>
    </div>
  </header>

  <div class="container">
    <section class="layout">
      <div class="bouncing">
        <img src="{{@asset('chrome.webp')}}" alt="chrome">
        <img src="{{@asset('node.webp')}}" alt="edg">
        <img src="{{@asset('ts.webp')}}" alt="mozila">
        <img src="{{@asset('vs.webp')}}" alt="vs">
        <img src="{{@asset('js.webp')}}" alt="js">

      </div>
      <h1>
        <span class="fastest">Create and share</span>,<br> beautiful images <br> of your source code.
      </h1>

      <div class="hero-cta">
        <a class="button button-primary" href="https://helpystack.vercel.app/">Sign up</a>
        <a class="button button-secondary" href="https://helpystack.vercel.app/">Sign in</a>
      </div>
    </section>
    <h1 class="testimonials-header-text">Proudly used by the <strong>world's best.</strong></h1>
    <section class="testimonials-wrap">
      <div class="testimonial-main">
        <div class="testimonial-header">
          <img src="https://avatars.githubusercontent.com/u/68166200?v=4" alt="pic">
        </div>
        <div class="testimonial-body">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
        </div>
        <div class="testimonial-footer">
          <a href="#">@Yusfuu</a>
        </div>
      </div>
      <div class="testimonial-main">
        <div class="testimonial-header">
          <img src="https://avatars.githubusercontent.com/u/77829205?v=4" alt="pic">
        </div>
        <div class="testimonial-body">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
        </div>
        <div class="testimonial-footer">
          <a href="#">@walid</a>
        </div>
      </div>

      <div class="testimonial-main">
        <div class="testimonial-header">
          <img src="https://avatars.githubusercontent.com/u/77799760?v=4" alt="pic">
        </div>
        <div class="testimonial-body">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
        </div>
        <div class="testimonial-footer">
          <a href="#">@Ayoub</a>
        </div>
      </div>
    </section>

    <section class="langpro">
      <div class="main">
        <h1>Dependencies, decluttered <strong>fullstack apps</strong></h1>
        <p>Contribute to projects without complicating your local setup. Spin up dev environments with a click—even for
          projects you haven't worked on before—and switch between them with ease.</p>
      </div>

      <div class="ws">
        <img src="{{@asset('workspace.png')}}" alt="workspace">
      </div>

    </section>

    <section class="pricing">
      <h1>Simple, transarent <strong>pricing</strong></h1>
      <div class="cards">
        <div class="card">
          <ul>
            <li class="pack">Free</li>
            <li id="basic" class="price bottom-bar"><span class="dollar">&dollar;</span> <span class="amount">0<span class="mounth">/m</span></span>
            </li>
            <li class="bottom-bar">500 MB Storage</li>
            <li class="bottom-bar">Your own private space</li>
            <li class="bottom-bar">Structured and searchable</li>
            <li><button class="btn">Join for free</button></li>
          </ul>
        </div>
        <div class="card">
          <ul>
            <li class="pack">Basic</li>
            <li id="professional" class="price bottom-bar"><span class="dollar">&dollar;</span> <span class="amount">6<span class="mounth">/m</span></span></li>
            <li class="bottom-bar">1 Gb Storage</li>
            <li class="bottom-bar">Code owners</li>
            <li class="bottom-bar">Send up to 5 GB</li>
            <li><button class="btn active-btn">Get started</button></li>
          </ul>
        </div>
        <div class="card shadow">
          <ul>
            <li class="pack">Business</li>
            <li id="master" class="price bottom-bar"><span class="dollar">&dollar;</span><span class="amount">12<span class="mounth">/m</span></span></li>
            <li class="bottom-bar">50 Gb Storage</li>
            <li class="bottom-bar">Pages and Wikis</li>
            <li class="bottom-bar">Send up to 10 GB</li>
            <li><button class="btn">Get started</button></li>
          </ul>
        </div>
      </div>
    </section>

    <section class="not-convinced">
      <div>
        <h3 class="section-title mt-0">Ready to get started ?</h3>
        <p>We have a generous free tier available to get you started right away.</p>
      </div>
      <a class="button button-primary" href="#">Get started for free</a>
    </section>

  </div>
  <footer>
    <ul>
      <li>
        <a>
          <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 11.5c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4 0 1.6 1.1 2.9 2.6 3.2-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H8c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4c.7-.5 1.3-1.1 1.7-1.8z">
            </path>
          </svg>
        </a>
      </li>
      <li>
        <a><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 8.2c-4.4 0-8 3.6-8 8 0 3.5 2.3 6.5 5.5 7.6.4.1.5-.2.5-.4V22c-2.2.5-2.7-1-2.7-1-.4-.9-.9-1.2-.9-1.2-.7-.5.1-.5.1-.5.8.1 1.2.8 1.2.8.7 1.3 1.9.9 2.3.7.1-.5.3-.9.5-1.1-1.8-.2-3.6-.9-3.6-4 0-.9.3-1.6.8-2.1-.1-.2-.4-1 .1-2.1 0 0 .7-.2 2.2.8.6-.2 1.3-.3 2-.3s1.4.1 2 .3c1.5-1 2.2-.8 2.2-.8.4 1.1.2 1.9.1 2.1.5.6.8 1.3.8 2.1 0 3.1-1.9 3.7-3.7 3.9.3.4.6.9.6 1.6v2.2c0 .2.1.5.6.4 3.2-1.1 5.5-4.1 5.5-7.6-.1-4.4-3.7-8-8.1-8z">
            </path>
          </svg>
        </a>
      </li>
      <li>
        <a>
          <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.023 24L14 17h-3v-3h3v-2c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V14H21l-1 3h-2.72v7h-3.257z">
            </path>
          </svg>
        </a>
      </li>
    </ul>
    <span>© {{year}} Simple. All rights reserved.</span>
  </footer>

</body>

</html>