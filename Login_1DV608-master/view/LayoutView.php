<?php


class LayoutView {
  
  public function render($htmlBody, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>

          <div class="container">
              ' . $htmlBody . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
}
