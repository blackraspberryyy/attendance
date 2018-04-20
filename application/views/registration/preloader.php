<style>
    /*----------------------- Preloader -----------------------*/
    body.preloader-site {
        overflow: scroll;
    }

    .preloader-wrapper {
        height: 100%;
        width: 100%;
        background: #FFF;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999999;
    }

    .preloader-wrapper .preloader {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 120px;
    }
    .loader {
        border: 8px solid #f3f3f3; /* Light grey */
        border-top: 8px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 80px;
        height: 80px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
<div class="preloader-wrapper">
    <div class="preloader">
        <div class="loader"></div>
    </div>
</div>