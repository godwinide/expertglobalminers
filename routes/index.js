const router = require("express").Router();

router.get("/", (req,res) => {
    try{
        return res.render("index", {pageTitle: "Welcome", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/contact", (req,res) => {
    try{
        return res.render("contact", {pageTitle: "Contact Us", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/announcements", (req,res) => {
    try{
        return res.render("announcements", {pageTitle: "Announcements", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/about", (req,res) => {
    try{
        return res.render("about", {pageTitle: "About Us", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/faqs", (req,res) => {
    try{
        return res.render("faqs", {pageTitle: "FAQ", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/forex-jobs", (req,res) => {
    try{
        return res.render("forex-jobs", {pageTitle: "forex-jobs", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/payment-method", (req,res) => {
    try{
        return res.render("payment-method", {pageTitle: "Payment Method", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/forex-trading-products", (req,res) => {
    try{
        return res.render("forex-trading-products", {pageTitle: "forex trading products", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/forex", (req,res) => {
    try{
        return res.render("forex", {pageTitle: "forex trading products", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/indices", (req,res) => {
    try{
        return res.render("indices", {pageTitle: "forex trading products", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/stocks", (req,res) => {
    try{
        return res.render("Stocks", {pageTitle: "forex trading products", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/cryptocurrency", (req,res) => {
    try{
        return res.render("cryptocurrency", {pageTitle: "forex trading products", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/best-forex-trading-platform", (req,res) => {
    try{
        return res.render("best-forex-trading-platform", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/metatrader-4-pc", (req,res) => {
    try{
        return res.render("metatrader-4-pc", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/metatrader-4-iphone-trader", (req,res) => {
    try{
        return res.render("metatrader-4-iphone-trader", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/metatrader-4-ipad-trader", (req,res) => {
    try{
        return res.render("metatrader-4-ipad-trader", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/metatrader-4-android", (req,res) => {
    try{
        return res.render("metatrader-4-android", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/micro-trading-account", (req,res) => {
    try{
        return res.render("micro-trading-account", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/standard-micro-trading-account", (req,res) => {
    try{
        return res.render("standard-micro-trading-account", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/ECN-account", (req,res) => {
    try{
        return res.render("ECN-account", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/ECN-pro-account", (req,res) => {
    try{
        return res.render("ECN-pro-account", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/vip-trading-account", (req,res) => {
    try{
        return res.render("vip-trading-account", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/trading-account-comparison", (req,res) => {
    try{
        return res.render("trading-account-comparison", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/forex-bonuses-and-promotions", (req,res) => {
    try{
        return res.render("forex-bonuses-and-promotions", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/Forex-Credit-Bonus-100", (req,res) => {
    try{
        return res.render("Forex-Credit-Bonus-100", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/tradable_bonuses30", (req,res) => {
    try{
        return res.render("tradable_bonuses30", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/start_copying", (req,res) => {
    try{
        return res.render("start_copying", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/start_copying", (req,res) => {
    try{
        return res.render("start_copying", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/trading-tools", (req,res) => {
    try{
        return res.render("trading-tools", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/forex-beginner-course", (req,res) => {
    try{
        return res.render("forex-beginner-course", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});

router.get("/economic_calendar", (req,res) => {
    try{
        return res.render("economic_calendar", {pageTitle: "plans", req});
    }
    catch(err){
        return res.redirect("/");
    }
});




module.exports = router;