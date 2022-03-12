const {model, Schema} = require("mongoose");

const UserSchema = new Schema({
    firstname:{
        type: String,
        required: true
    },
    lastname:{
        type: String,
        required: true
    },
    email:{
        type: String,
        required: true
    },
    phone:{
        type: String,
        required: true
    },
    country:{
        type: String,
        required: true
    },
    zip_code:{
        type: String,
        required: true
    },
    currency:{
        type: String,
        required: true
    },
    password:{
        type: String,
        required: true
    },
    balance:{
        type: Number,
        required: false,
        default: 0
    },    
    debt:{
        type: Number,
        required: false,
        default: 0
    },    
    pending:{
        type: Number,
        required: false,
        default: 0
    },
    product_type:{
        type: String,
        required: true
    },
    investment_plans:{
        type: String,
        required: false
    },
    investment_options:{
        type: String,
        required: false
    },
    verify_status:{
        type: String,
        required: false,
        default: "pre-activated"
    },
    dob: {
        type: Date,
        required: false,
        default: Date.now()
    },
    regDate:{
        type: Date,
        required: false,
        default: Date.now()
    }
});

module.exports = User = model("User", UserSchema);