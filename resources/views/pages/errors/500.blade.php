<!doctype html>
<html lang="en" data-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><style>.t{fill:%230a0a0a}.m{stroke:%23fafafa}@media(prefers-color-scheme: dark){.t{fill:%23fafafa}.m{stroke:%230a0a0a}}</style><rect class="t" width="512" height="512" rx="112"/><path class="m" d="M 392 144 H 200 A 56 56 0 0 0 200 256 H 312 A 56 56 0 0 1 312 368 H 120" fill="none" stroke-width="76" stroke-linecap="round" stroke-linejoin="round"/></svg>'/>
    <title>500 Server Error · Meridian</title>
    <link rel="stylesheet" href="{{ asset('css/meridian/style.css') }}" />
  </head>
  <body>
    <main class="error-page">
      <div class="error-page__content">
        <span class="error-page__code">500</span>
        <h1 class="error-page__title">Server Error</h1>
        <p class="error-page__description">Something went wrong on our end. We're working to fix it.</p>
        <a href="{{ route('dashboard') }}" class="button button--primary">
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="none" stroke="currentColor" stroke-width="1.5" d="m15 19l-7-7 7-7"/>
          </svg>
          Back to Dashboard
        </a>
      </div>
    </main>
  </body>
</html>
