https://formden.com/blog/isolate-bootstrap

1. Customize Bootstrap CSS

First, download files: `bootstrap.css` and `bootstrap-theme.css` (optional)

2. Install LESS on your computer

- Install npm
- npm install -g less

3. Create a LESS file to prefix your CSS

Create a file called prefix.less that contains the following:

.bootstrap-iso {
  @import (less) 'bootstrap.css';
  @import (less) 'bootstrap-theme.css';  /* optional */
}

4. Compile your LESS file

lessc prefix.less bootstrap-iso.css

5. Replace .bootsrap-iso body

- Open boostrap-iso.css in a text editor.

- Find all instance of: .bootstrap-iso body and .bootstrap-iso html
- Replace with: .bootstrap-iso

6. You're done!