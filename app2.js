const express = require("express");

const app = express();

app.get("/", (req, res) => {
    res.send("app 2 hello");
});

app.listen(2002, () => console.log("port 2002 runing"));
