// document.addEventListener("DOMContentLoaded", function () {
//     const form = document.querySelector("#application form");
//     const submitBtn = document.getElementById("sucsessfly");

//         console.log(form, submitBtn);
//     submitBtn.addEventListener("click", function (e) {
//         e.preventDefault(); // يمنع إعادة تحميل الصفحة

//         // جلب قيم الحقول
//         const name = document.querySelector('input[placeholder="User-Name"]').value.trim();
//         const age = document.querySelector('input[placeholder="Your-Age"]').value.trim();
//         const phone = document.querySelector('input[placeholder="Phone-Number"]').value.trim();
//         const datetime = document.querySelector('input[type="Datetime-Local"]').value;
//         const gender = document.querySelector('input[name="male"]:checked') || document.querySelector('input[name="female"]:checked');

//         // التحقق إن كل الحقول مملوءة
//         if (!name || !age || !phone || !datetime || !gender) {
//             alert("يرجى ملء جميع الحقول قبل الحجز!");
//             return;
//         }

//         // لو كل حاجة تمام → يطلع الألرت الجميل ده
//         alert(`
// تم حجز الموعد بنجاح!

// الاسم: ${name}
// العمر: ${age} سنة
// رقم التليفون: ${phone}
// تاريخ ووقت الموعد: ${new Date(datetime).toLocaleString('ar-EG')}
// الجنس: ${gender.value === "male" ? "ذكر" : "أنثى"}

// شكرًا لثقتك فينا، هنتواصل معاك قريب جداً
//         `);

//         // إعادة تعيين الفورم بعد الحجز (اختياري)
//         form.reset();
//     });
// });



document.addEventListener("DOMContentLoaded", function () {
  // خلاص، مش هنمنع الإرسال، خلّي الفورم يروح لـ submit.php عادي
});






