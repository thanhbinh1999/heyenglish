const express = require("express");

const app = express();

app.get("/", (req, res) => {
    res.send("app 3 hello");
});

app.listen(2003, () => console.log("port 2003 runing"));




