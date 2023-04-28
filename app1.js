const express = require("express");

const app = express();

app.get("/", (req, res) => {
    res.send("app 1 hello");
});

app.listen(2001, () => console.log("port 2001 runing"));
