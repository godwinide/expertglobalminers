const router = require("express").Router();
const User = require("../model/User");
const passport = require("passport");
const bcrypt = require("bcryptjs");

router.get("/signin", (req,res) => {
    try{
        return res.render("trade/signin", {pageTitle: "Login", req, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});

router.post('/signin', (req, res, next) => {
    passport.authenticate('local', {
        successRedirect: '/trade/dashboard',
        failureRedirect: '/trade/signin',
        failureFlash: true
    })(req, res, next);
});

router.get('/logout', (req, res) => {
    req.logout();
    req.flash('success_msg', 'You are logged out');
    res.redirect('/signin');
});


router.get("/signup", (req,res) => {
    try{
        return res.render("trade/signup", {pageTitle: "Signup", req, layout: "layout2"});
    }catch(err){
        return res.redirect("/");
    }
});


router.post('/signup', async (req,res) => {
    try{
        const {
            firstname, 
            lastname, 
            email, 
            phone, 
            country, 
            zip, 
            currency,
            investment_options,
            investment_plans,
            product_type, 
            password, 
            password2   
        } = req.body;
        const user = await User.findOne({email});
        if(user){
            return res.render("signup", {...req.body,error_msg:"A User with that email or email already exists", pageTitle: "Signup"});
        } else{
            if(!firstname || !lastname || !country || !investment_options || !investment_plans || !product_type || !email || !phone || !password || !password2){
                return res.render("trade/signup", {...req.body,error_msg:"Please fill all fields", pageTitle: "Signup"});
            }else{
                if(password !== password2){
                    return res.render("trade/signup", {...req.body,error_msg:"Both passwords are not thesame", pageTitle: "Signup"});
                }
                if(password2.length < 6 ){
                    return res.render("trade/signup", {...req.body,error_msg:"Password length should be min of 6 chars", pageTitle: "Signup"});
                }
                
                const newUser = {
                    firstname,
                    lastname,
                    email,
                    phone,
                    country: country[0],
                    zip_code: zip, 
                    currency,
                    investment_options,
                    investment_plans,
                    product_type, 
                    password
                };
                const salt = await bcrypt.genSalt();
                const hash = await bcrypt.hash(password2, salt);
                newUser.password = hash;
                const _newUser = new User(newUser);
                await _newUser.save();
                req.flash("success_msg", "Register success, you can now login");
                return res.redirect("/trade/signin");
            }
        }
    }catch(err){
        console.log(err)
    }
})



module.exports = router;