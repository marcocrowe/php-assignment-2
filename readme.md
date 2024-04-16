
# Assignment 2

## Requirements

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [VS Code](https://code.visualstudio.com/)

## Run

To run open the terminal and run the following commands:

```bash
php -S localhost:8000
```

Then open your browser and go to [http://localhost:8000](http://localhost:8000)

## Link to XAMPP htdocs with a symbolic link

```cmd
mklink /D "C:\LinkToFolder" "C:\Users\Name\OriginalFolder"
```

### Example

Create a symbolic link for the GitHub folder.

Open the terminal in your `htdocs` folder and run the following command:

```cmd
mklink /D "crud-web-assignment-php" "C:\Users\user\Documents\GitHub\crud-web-assignment-php"
```

<http://localhost/crud-web-assignment-php>

---

## References

- [How-To Geek](https://www.howtogeek.com/16226/complete-guide-to-symbolic-links-symlinks-on-windows-or-linux/)
