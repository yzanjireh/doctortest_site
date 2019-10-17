
            function validateName(field)
            {
                return (field == "") ? "نام وارد نشده است\n" : ""
            }
            function validateSname(field)
            {
                return (field == "") ? "نام خانوادگی وارد نشده است.\n" : ""
            }          
            function validatePassword(field)
            {
                if (field == "")
                    return "پسورد وارد نشده است.\n"
                else if (field.length < 6)
                    return "پسورد حداقل باید 6 کاراکتر باشد.\n"
//                else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) ||
//                        !/[0-9]/.test(field))
//                    return "Passwords require one each of a-z, A-Z and 0-9.\n"
                return ""
            }
            function validateEmail(field)
            {
                if (field == "")
                    return "ایمیل وارد نشده است.\n"
                else if (!((field.indexOf(".") > 0) &&
                        (field.indexOf("@") > 0)) ||
                        /[^a-zA-Z0-9.@_-]/.test(field))
                    return "آدرس ایمیل را درست وارد کنید\n"
                return ""
            }
