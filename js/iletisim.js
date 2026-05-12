/* ============================================================
   1) VANILLA JAVASCRIPT DOĞRULAMA
   ============================================================ */
function validateWithJS() {
    let isValid = true;

    // Tüm hata mesajlarını gizle
    document.querySelectorAll(".error-text").forEach(el => el.classList.remove("visible"));
    document.querySelectorAll(".form-control, .form-select").forEach(el => el.classList.remove("is-invalid"));
    document.getElementById("js-success").style.display = "none";


    // Ad Soyad — boş mu?
    const name = document.getElementById("name").value.trim();
    if (!name) {
        showJsError("name", "err-name");
        isValid = false;
    }

    // E-posta — boş mu ve format doğru mu?
    const email = document.getElementById("email").value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailRegex.test(email)) {
        showJsError("email", "err-email");
        isValid = false;
    }

    // Telefon — sadece rakam mı ve 10-11 hane mi?
    const phone = document.getElementById("phone").value.trim();
    const phoneRegex = /^[0-9]{10,11}$/;
    if (!phone || !phoneRegex.test(phone)) {
        showJsError("phone", "err-phone");
        isValid = false;
    }

    // Konu — seçildi mi?
    const subject = document.getElementById("subject").value;
    if (!subject) {
        showJsError("subject", "err-subject");
        isValid = false;
    }

    // Mesaj — boş mu?
    const message = document.getElementById("message").value.trim();
    if (!message) {
        showJsError("message", "err-message");
        isValid = false;
    }

    // Gizlilik — işaretlendi mi?
    const privacy = document.getElementById("privacy").checked;
    if (!privacy) {
        showJsError("privacy", "err-privacy");
        isValid = false;
    }

    if (isValid) {
        document.getElementById("js-success").style.display = "block";
        document.getElementById("js-success").scrollIntoView({ behavior: "smooth" });
    }
}

function showJsError(fieldId, errorId) {
    const field = document.getElementById(fieldId);
    if (field) field.classList.add("is-invalid");
    const err = document.getElementById(errorId);
    if (err) err.classList.add("visible");
}


/* ============================================================
   2) VUE.JS DOĞRULAMA
   ============================================================ */
const { createApp } = Vue;

createApp({
    data() {
        return {
            form: {
                name: "",
                email: "",
                phone: "",
                birthdate: "",
                gender: "",
                subject: "",
                interests: [],
                message: "",
                privacy: false
            },
            vueErrors: {},
            vueSuccess: false
        };
    },
    methods: {
        validateWithVue() {
            this.vueErrors = {};
            this.vueSuccess = false;


            // Ad Soyad
            if (!this.form.name.trim()) {
                this.vueErrors.name = "Ad soyad boş bırakılamaz.";
            }

            // E-posta
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!this.form.email.trim()) {
                this.vueErrors.email = "E-posta boş bırakılamaz.";
            } else if (!emailRegex.test(this.form.email)) {
                this.vueErrors.email = "Geçerli bir e-posta adresi girin.";
            }

            // Telefon
            const phoneRegex = /^[0-9]{10,11}$/;
            if (!this.form.phone.trim()) {
                this.vueErrors.phone = "Telefon boş bırakılamaz.";
            } else if (!phoneRegex.test(this.form.phone)) {
                this.vueErrors.phone = "Telefon yalnızca rakamlardan oluşmalı ve 10-11 haneli olmalıdır.";
            }

            // Konu
            if (!this.form.subject) {
                this.vueErrors.subject = "Lütfen bir konu seçin.";
            }

            // Mesaj
            if (!this.form.message.trim()) {
                this.vueErrors.message = "Mesaj boş bırakılamaz.";
            }

            // Gizlilik
            if (!this.form.privacy) {
                this.vueErrors.privacy = "Devam etmek için gizlilik onayı vermelisiniz.";
            }

            // Hata yoksa başarılı
            if (Object.keys(this.vueErrors).length === 0) {
                this.vueSuccess = true;
                this.$nextTick(() => {
                    document.getElementById("vue-success")?.scrollIntoView({ behavior: "smooth" });
                });
            }
        }
    }
}).mount("#contactApp");
