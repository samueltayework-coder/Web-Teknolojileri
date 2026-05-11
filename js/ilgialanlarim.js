document.addEventListener("DOMContentLoaded", () => {
    // Favori dizilerin TVMaze ID'leri
    // 82: Game of Thrones, 170: Orange is the New Black, 169: Breaking Bad,
    // 526: The Office, 2993: Stranger Things, 66: The Big Bang Theory,
    // 618: Better Call Saul, 216: Rick and Morty
    const showIds = [82, 170, 169, 526, 2993, 66, 618, 216];

    // Türkçe açıklamalar (TVMaze ID'ye göre)
    const turkishSummaries = {
        82:   "Westeros kıtasında geçen bu destansı dizi; güç, entrika ve hayatta kalma mücadelesiyle birbirine bağlı soylu aileler, savaşçılar ve büyücülerin hikâyesini anlatır.",
        170:  "Piper Chapman, on yıl önce uyuşturucu kaçakçılığına karışmasının bedelini ödemek üzere 15 aylık hapis cezasına çarptırılır. Litchfield Kadın Cezaevi'ndeki zorlu ve bazen komik hayatını konu alan sürükleyici bir dizi.",
        169:  "Lise kimya öğretmeni Walter White, kanser teşhisiyle hayatının alt üst olmasının ardından öğrencisi Jesse Pinkman ile uyuşturucu dünyasına adım atar. Giderek büyüyen bir gerilim şaheseri.",
        526:  "Scranton, Pennsylvania'daki sıradan bir kâğıt şirketinin çalışanlarının günlük hayatını konu alan bu mockümenter komedi, hem güldürür hem düşündürür.",
        2993: "1980'lerin Hawkins kasabasında bir çocuğun gizemli kaybolmasıyla başlayan olaylar, doğaüstü güçleri ve gizli devlet deneylerini gün yüzüne çıkarır.",
        66:   "Caltech'te çalışan dört tuhaf ama dâhi bilim insanının sosyal hayattaki komik mücadelelerini anlatan, yıllarca izletmeye devam eden bir klasik.",
        618:  "Breaking Bad'in ödüllü yan hikâyesi: Jimmy McGill'in Saul Goodman'a dönüşümünü, Mike Ehrmantraut ve Albuquerque suç dünyasını mercek altına alır.",
        216:  "Dâhi büyükbaba Rick ile torunu Morty'nin boyutlar arası çılgın maceralarını anlatan bu animasyon, derin felsefi sorgulamalarla absürt komediyi harmanlıyor."
    };

    const container = document.getElementById("shows-container");
    const loader = document.getElementById("loader");
    const errorMessage = document.getElementById("error-message");

    async function fetchFavoriteShows() {
        try {
            const fetchPromises = showIds.map(id =>
                fetch(`https://api.tvmaze.com/shows/${id}`).then(res => {
                    if (!res.ok) throw new Error("API yanıt vermedi");
                    return res.json();
                })
            );

            const shows = await Promise.all(fetchPromises);

            loader.style.display = "none";
            container.style.display = "flex";

            shows.forEach(show => {
                const col = document.createElement("div");
                col.className = "col-12 col-sm-6 col-lg-3";

                // Türkçe açıklama varsa kullan, yoksa API'den al
                const summary = turkishSummaries[show.id]
                    || (show.summary ? show.summary.replace(/<[^>]*>?/gm, '') : 'Açıklama bulunamadı.');

                const genresHtml = show.genres.map(genre => `<span class="genre-badge">${genre}</span>`).join('');
                const rating = show.rating.average ? `★ ${show.rating.average}` : '★ N/A';

                col.innerHTML = `
                    <div class="show-card">
                        <div class="show-image-container">
                            <img src="${show.image ? show.image.original : 'https://via.placeholder.com/210x295'}" alt="${show.name}">
                            <div class="show-rating">${rating}</div>
                        </div>
                        <div class="show-info">
                            <h3 class="show-title">${show.name}</h3>
                            <div class="show-genres">${genresHtml}</div>
                            <p class="show-summary">${summary}</p>
                            <a href="${show.url}" target="_blank" class="show-link">Detayları Gör →</a>
                        </div>
                    </div>`;
                container.appendChild(col);
            });

        } catch (error) {
            console.error("Veri çekme hatası:", error);
            loader.style.display = "none";
            errorMessage.classList.remove("d-none");
        }
    }

    fetchFavoriteShows();
});
