<template>
    <footer :class="'footer ' + footerClassList">
        <div class="footer__inner">

            <div class="footer__left">
                <h3>
                    BLOG.
                </h3>
            </div>
            <div class="footer__right">
                <router-link to="/contact">Contact</router-link>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        data(){
            return {
                'footerClassList': null,
            }
        },
        methods: {
            /* check the window height for the footer */
            footerWindowHeightCheck(){

                this.footerClassList = (window.innerHeight > document.body.offsetHeight)
                ? "footer__sticky footer__sticky--bottom"
                    : null

            }
        },

        mounted(){
            this.footerWindowHeightCheck()
        },
        
        updated(){
            this.footerWindowHeightCheck()
        }
    }
</script>
