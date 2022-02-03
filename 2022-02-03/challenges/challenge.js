// Node.js 16
const fs = require("node:fs");
const http = require("node:http");
const Url = require("node:url");
const path = require("node:path");

const server = http.createServer((req, res) => {
  if (req.url.startsWith("/user/")) {
    const url = new Url.URL(`http://${req.headers.host}${req.url}`);

    if (
      url.searchParams.get("userId") &&
      !isNaN(parseInt(url.searchParams.get("userId")))
    ) {
      // Each user has a folder, go into that folder and get their user.json file
      // and return the text
      const id = url.searchParams.get("userId");
      const userFileInput = url.searchParams.get("file") ?? "user.json";
      const userFileParts = userFileInput.split("/");
      const userFile = userFileParts[userFileParts.length - 1];

      const filePath = path.resolve("/users", id, userFile);

      fs.readFile(filePath, (err, text) => {
        if (err) throw err;

        res.write(text.toString());
        res.end();
      });
    } else {
      res.statusCode = 400;
      res.end();
    }
  } else {
    res.statusCode = 404;
    res.end();
  }
});

server.listen(8000);
