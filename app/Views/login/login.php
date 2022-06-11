<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/tailwind1.css">
    <!-- <link rel="stylesheet" href="/css/sb-admin-2.min.css"> -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="h-screen bg-gradient-to-tl from-green-400 to-indigo-900 py-16 px-4 flex justify-center items-center w-full">

        <div class="flex flex-col items-center justify-center">

            <div class="bg-white shadow-2xl rounded-md w-full py-14 px-20 my-auto">
                <div class="space-y-4">
                    <p tabindex="0" class="mb-7 focus:outline-none text-center text-xl font-extrabold leading-6 text-gray-800">Login to E-SURAT</p>
                    <div class="flex items-center justify-center">
                        <img src="/img/bps.png" class="w-40 h-32" alt="logo BPS">
                    </div>
                    <!-- <p tabindex="0" class="focus:outline-none text-sm mt-4 font-medium leading-none text-gray-500">Dont have account? <a href="javascript:void(0)" class="hover:text-gray-500 focus:text-gray-500 focus:outline-none focus:underline hover:underline text-sm font-medium leading-none  text-gray-800 cursor-pointer"> Sign up here</a></p> -->
                    <button aria-label="Continue with google" role="button" class="focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-gray-700 py-3.5 px-4 border rounded-lg border-gray-700 flex items-center w-full mt-20 bg-gray-200 hover:bg-gray-100 shadow-inner">
                        <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.9892 10.1871C18.9892 9.36767 18.9246 8.76973 18.7847 8.14966H9.68848V11.848H15.0277C14.9201 12.767 14.3388 14.1512 13.047 15.0812L13.0289 15.205L15.905 17.4969L16.1042 17.5173C17.9342 15.7789 18.9892 13.221 18.9892 10.1871Z" fill="#4285F4" />
                            <path d="M9.68813 19.9314C12.3039 19.9314 14.4999 19.0455 16.1039 17.5174L13.0467 15.0813C12.2286 15.6682 11.1306 16.0779 9.68813 16.0779C7.12612 16.0779 4.95165 14.3395 4.17651 11.9366L4.06289 11.9465L1.07231 14.3273L1.0332 14.4391C2.62638 17.6946 5.89889 19.9314 9.68813 19.9314Z" fill="#34A853" />
                            <path d="M4.17667 11.9366C3.97215 11.3165 3.85378 10.6521 3.85378 9.96562C3.85378 9.27905 3.97215 8.6147 4.16591 7.99463L4.1605 7.86257L1.13246 5.44363L1.03339 5.49211C0.37677 6.84302 0 8.36005 0 9.96562C0 11.5712 0.37677 13.0881 1.03339 14.4391L4.17667 11.9366Z" fill="#FBBC05" />
                            <path d="M9.68807 3.85336C11.5073 3.85336 12.7344 4.66168 13.4342 5.33718L16.1684 2.59107C14.4892 0.985496 12.3039 0 9.68807 0C5.89885 0 2.62637 2.23672 1.0332 5.49214L4.16573 7.99466C4.95162 5.59183 7.12608 3.85336 9.68807 3.85336Z" fill="#EB4335" />
                        </svg>
                        <a href="/Login/Google" class="text-base text-center font-medium ml-4 text-gray-700">Continue with Google</a>
                    </button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>