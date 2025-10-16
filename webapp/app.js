const STORAGE_KEY = "diskusi-asn-trenggalek";

const defaultThreads = [
    {
        id: createId(),
        title: "Integrasi data pelayanan perizinan lintas OPD",
        summary: "Mengintegrasikan dashboard perizinan satu pintu dengan data Dinas Penanaman Modal dan PTSP serta Dinas Tenaga Kerja untuk mempercepat validasi usaha mikro.",
        category: "Transformasi Digital",
        opd: "DPMPTSP",
        author: "Rina Setyowati",
        createdAt: "2024-10-12T09:15:00.000Z",
        replies: 12,
        lastActivity: "2024-10-16T03:40:00.000Z",
        tags: ["dashboard", "perizinan", "data-sharing"]
    },
    {
        id: createId(),
        title: "Strategi percepatan penyaluran bantuan pangan",
        summary: "Menyusun SOP kolaborasi antara Dinas Sosial, Kecamatan, dan perangkat desa agar distribusi bansos minggu ketiga Oktober tepat sasaran.",
        category: "Pelayanan Sosial",
        opd: "Dinas Sosial",
        author: "Bambang Supriyadi",
        createdAt: "2024-10-10T06:55:00.000Z",
        replies: 8,
        lastActivity: "2024-10-15T08:45:00.000Z",
        tags: ["bansos", "kolaborasi", "data-terpadu"]
    },
    {
        id: createId(),
        title: "Rencana aksi green office untuk OPD kabupaten",
        summary: "Mencari praktik terbaik pengelolaan sampah organik dan pemanfaatan energi surya di gedung kantor pemerintah daerah.",
        category: "Inovasi Layanan",
        opd: "DLH",
        author: "Yustinus Pradana",
        createdAt: "2024-10-08T04:35:00.000Z",
        replies: 15,
        lastActivity: "2024-10-16T01:15:00.000Z",
        tags: ["green-office", "energi", "sampah"]
    },
    {
        id: createId(),
        title: "Koordinasi Posko Siaga Bencana jelang musim hujan",
        summary: "Menyiapkan personel terpadu antara BPBD, Dinas PUPR, Dinkes, dan perangkat desa untuk mitigasi banjir di wilayah Watulimo.",
        category: "Tanggap Darurat",
        opd: "BPBD",
        author: "Sri Wahyuni",
        createdAt: "2024-10-14T10:20:00.000Z",
        replies: 19,
        lastActivity: "2024-10-16T05:10:00.000Z",
        tags: ["siaga-bencana", "koordinasi", "watulimo"]
    },
    {
        id: createId(),
        title: "Implementasi Sistem Merit dalam rotasi jabatan",
        summary: "Berbagi praktik penilaian kinerja dan pengembangan kompetensi untuk mendukung rotasi pejabat administrator yang transparan.",
        category: "Manajemen ASN",
        opd: "BKPSDM",
        author: "Ratna Surya",
        createdAt: "2024-10-05T02:40:00.000Z",
        replies: 11,
        lastActivity: "2024-10-13T07:05:00.000Z",
        tags: ["sistem-merit", "kinerja", "rotasi"]
    }
];

const categories = [
    "Transformasi Digital",
    "Pelayanan Sosial",
    "Inovasi Layanan",
    "Manajemen ASN",
    "Tanggap Darurat",
    "Pengelolaan Keuangan",
    "Kesehatan",
    "Pendidikan"
];

const agendaItems = [
    {
        title: "Lokakarya Layanan Publik Responsif",
        date: "21 Oktober 2024",
        time: "09.00 - 12.00",
        location: "Command Center Trenggalek",
        owner: "Dinas Kominfo"
    },
    {
        title: "Klinik Data Terpadu Kesejahteraan",
        date: "23 Oktober 2024",
        time: "13.00 - 15.00",
        location: "Aula Dinas Sosial",
        owner: "Dinas Sosial"
    },
    {
        title: "Forum Koordinasi SIGAP Bencana",
        date: "25 Oktober 2024",
        time: "08.00 - 10.00",
        location: "Kantor BPBD",
        owner: "BPBD"
    }
];

const announcements = [
    {
        title: "Perbup 45/2024 tentang SPBE",
        summary: "Seluruh OPD diminta menyesuaikan SOP internal terkait transformasi digital dan keamanan informasi.",
        link: "https://jdih.trenggalekkab.go.id"
    },
    {
        title: "Pembukaan Inovasi Pelayanan Publik 2024",
        summary: "Registrasi proposal inovasi dibuka hingga 5 November 2024 melalui portal siMastro.",
        link: "https://simastro.trenggalekkab.go.id"
    },
    {
        title: "Surat Edaran Netralitas ASN",
        summary: "Seluruh ASN wajib menjaga netralitas pada masa pemilihan kepala desa bulan depan.",
        link: "https://asn.trenggalekkab.go.id"
    }
];

const resources = [
    {
        title: "Panduan Kolaborasi Lintas OPD",
        description: "Template alur koordinasi dan pelacakan tindak lanjut antar unit kerja.",
        link: "https://drive.google.com"
    },
    {
        title: "Toolkit Penyusunan SOP Digital",
        description: "Checklist implementasi SPBE untuk unit layanan publik.",
        link: "https://drive.google.com"
    },
    {
        title: "Dashboard Kinerja Kabupaten",
        description: "Data capaian indikator prioritas pembangunan daerah.",
        link: "https://data.trenggalekkab.go.id"
    }
];

const insights = [
    "Topik transformasi digital meningkat 35% dibanding bulan lalu.",
    "OPD sosial menjadi kolaborator paling aktif pada diskusi lintas sektor.",
    "80% isu yang ditindaklanjuti berawal dari koordinasi informal di forum ini.",
    "Diskusi dengan data pendukung memiliki peluang 2x lebih besar ditindaklanjuti.",
    "Agenda tatap muka mingguan meningkatkan respon antar OPD hingga 45%."
];

function cloneData(value) {
    if (typeof structuredClone === "function") {
        return structuredClone(value);
    }
    return JSON.parse(JSON.stringify(value));
}

function createId() {
    if (typeof crypto !== "undefined" && typeof crypto.randomUUID === "function") {
        return crypto.randomUUID();
    }
    return `id-${Date.now().toString(36)}-${Math.random().toString(36).slice(2, 10)}`;
}

const state = {
    threads: loadThreads(),
    searchQuery: "",
    category: "semua"
};

const elements = {
    totalDiskusi: document.getElementById("totalDiskusi"),
    totalPeserta: document.getElementById("totalPeserta"),
    diskusiMingguIni: document.getElementById("diskusiMingguIni"),
    threadList: document.getElementById("daftarDiskusi"),
    search: document.getElementById("pencarian"),
    categoryFilter: document.getElementById("filterKategori"),
    kategoriForm: document.getElementById("kategori"),
    form: document.getElementById("formDiskusi"),
    feedback: document.getElementById("formFeedback"),
    trending: document.getElementById("trendingList"),
    opdTeraktif: document.getElementById("opdTeraktif"),
    updateKebijakan: document.getElementById("updateKebijakan"),
    agendaList: document.getElementById("agendaList"),
    pengumumanList: document.getElementById("pengumumanList"),
    resourceList: document.getElementById("resourceList"),
    insightText: document.getElementById("insightText"),
    tahunBerjalan: document.getElementById("tahunBerjalan"),
    panduanDialog: document.getElementById("panduanDialog"),
    buttonPanduan: document.getElementById("lihatPanduan"),
    buttonTutupPanduan: document.getElementById("tutupPanduan"),
    buttonPahamiPanduan: document.getElementById("pahamiPanduan"),
    buttonBuatDiskusi: document.getElementById("buatDiskusi")
};

function loadThreads() {
    const stored = localStorage.getItem(STORAGE_KEY);
    if (!stored) {
        saveThreads(defaultThreads);
        return cloneData(defaultThreads);
    }

    try {
        const parsed = JSON.parse(stored);
        if (Array.isArray(parsed) && parsed.length) {
            return cloneData(parsed);
        }
    } catch (error) {
        console.error("Gagal membaca data diskusi:", error);
    }

    saveThreads(defaultThreads);
    return cloneData(defaultThreads);
}

function saveThreads(data) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
}

function renderStats() {
    elements.totalDiskusi.textContent = state.threads.length;

    const participants = new Set(state.threads.map(thread => thread.author));
    elements.totalPeserta.textContent = participants.size;

    const aWeekAgo = Date.now() - 7 * 24 * 60 * 60 * 1000;
    const recent = state.threads.filter(thread => new Date(thread.createdAt).getTime() >= aWeekAgo);
    elements.diskusiMingguIni.textContent = recent.length;
}

function renderThreads() {
    const filtered = state.threads.filter(thread => {
        const matchesCategory = state.category === "semua" || thread.category === state.category;
        const matchesSearch = [thread.title, thread.summary, thread.opd, thread.tags?.join(" ")]
            .join(" ")
            .toLowerCase()
            .includes(state.searchQuery.toLowerCase());
        return matchesCategory && matchesSearch;
    });

    if (!filtered.length) {
        elements.threadList.innerHTML = `<div class="empty-state">Tidak ada diskusi yang sesuai. Coba ubah kata kunci atau kategori.</div>`;
        return;
    }

    elements.threadList.innerHTML = filtered
        .map(thread => {
            const createdAt = formatDate(thread.createdAt);
            const lastActivity = formatDate(thread.lastActivity || thread.createdAt);
            const tags = thread.tags?.map(tag => `<span class="tag">#${tag}</span>`).join("") || "";
            return `
                <article class="thread-card">
                    <header>
                        <h3>${thread.title}</h3>
                        <div class="thread-stats">
                            <span>💬 ${thread.replies}</span>
                            <span>👁️ ${Math.max(48, Math.round(thread.replies * 9.5))}</span>
                        </div>
                    </header>
                    <div class="thread-meta">
                        <span>${thread.category}</span>
                        <span>${thread.opd}</span>
                        <span>Oleh ${thread.author}</span>
                        <span>Diajukan ${createdAt}</span>
                        <span>Aktivitas terakhir ${lastActivity}</span>
                    </div>
                    <p class="thread-content">${thread.summary}</p>
                    <div class="tag-group">
                        <span class="tag">#${slugify(thread.category)}</span>
                        <span class="tag">#${slugify(thread.opd)}</span>
                        ${tags}
                    </div>
                </article>
            `;
        })
        .join("");
}

function renderFilters() {
    categories.forEach(category => {
        const option = document.createElement("option");
        option.value = category;
        option.textContent = category;
        elements.categoryFilter.append(option.cloneNode(true));
        elements.kategoriForm.append(option);
    });
}

function renderTrending() {
    const frequency = new Map();
    state.threads.forEach(thread => {
        thread.tags?.forEach(tag => {
            frequency.set(tag, (frequency.get(tag) ?? 0) + 1);
        });
    });

    const trending = Array.from(frequency.entries())
        .sort((a, b) => b[1] - a[1])
        .slice(0, 5);

    if (!trending.length) {
        elements.trending.innerHTML = `<li>Tidak ada tag populer saat ini.</li>`;
        return;
    }

    elements.trending.innerHTML = trending
        .map(([tag, count]) => `<li><span>#${tag}</span><span>${count}</span></li>`)
        .join("");
}

function renderOpdTeraktif() {
    const counts = state.threads.reduce((acc, thread) => {
        acc[thread.opd] = (acc[thread.opd] ?? 0) + 1;
        return acc;
    }, {});

    const ranking = Object.entries(counts)
        .sort((a, b) => b[1] - a[1])
        .slice(0, 5);

    elements.opdTeraktif.innerHTML = ranking
        .map(([opd, total]) => `<li><span>${opd}</span><span>${total} diskusi</span></li>`)
        .join("");
}

function renderUpdates() {
    elements.updateKebijakan.innerHTML = announcements
        .map(item => `<li><strong>${item.title}</strong><div>${item.summary}</div></li>`)
        .join("");
}

function renderAgenda() {
    elements.agendaList.innerHTML = agendaItems
        .map(item => `
            <li class="agenda-item">
                <strong>${item.title}</strong>
                <span>${item.date} • ${item.time}</span>
                <span>${item.location}</span>
                <span>Penanggung jawab: ${item.owner}</span>
            </li>
        `)
        .join("");
}

function renderAnnouncements() {
    elements.pengumumanList.innerHTML = announcements
        .map(item => `
            <li>
                <strong>${item.title}</strong>
                <p>${item.summary}</p>
                <a href="${item.link}" target="_blank" rel="noreferrer">Baca selengkapnya</a>
            </li>
        `)
        .join("");
}

function renderResources() {
    elements.resourceList.innerHTML = resources
        .map(item => `
            <li>
                <a href="${item.link}" target="_blank" rel="noreferrer">
                    <span><strong>${item.title}</strong></span>
                    <span>${item.description}</span>
                </a>
            </li>
        `)
        .join("");
}

function setInsight() {
    const randomIndex = Math.floor(Math.random() * insights.length);
    elements.insightText.textContent = insights[randomIndex];
}

function setupEvents() {
    elements.search.addEventListener("input", event => {
        state.searchQuery = event.target.value.trim();
        renderThreads();
    });

    elements.categoryFilter.addEventListener("change", event => {
        state.category = event.target.value;
        renderThreads();
    });

    elements.form.addEventListener("submit", event => {
        event.preventDefault();
        const formData = new FormData(event.target);
        const newThread = {
            id: createId(),
            title: formData.get("judul").trim(),
            summary: formData.get("ringkasan").trim(),
            category: formData.get("kategori"),
            opd: formData.get("opd").trim(),
            author: formData.get("penulis").trim(),
            createdAt: new Date().toISOString(),
            replies: 0,
            lastActivity: new Date().toISOString(),
            tags: buildTags(formData.get("ringkasan"))
        };

        if (!validateThread(newThread)) {
            elements.feedback.textContent = "Mohon lengkapi seluruh field dengan benar.";
            elements.feedback.style.color = "#d9480f";
            return;
        }

        state.threads.unshift(newThread);
        saveThreads(state.threads);
        renderThreads();
        renderStats();
        renderTrending();
        renderOpdTeraktif();

        elements.form.reset();
        elements.feedback.textContent = "Diskusi berhasil dipublikasikan.";
        elements.feedback.style.color = "var(--success)";
        setTimeout(() => {
            elements.feedback.textContent = "";
        }, 3500);
    });

    elements.buttonPanduan.addEventListener("click", () => {
        elements.panduanDialog.showModal();
    });

    elements.buttonBuatDiskusi.addEventListener("click", () => {
        document.getElementById("formTitle").scrollIntoView({ behavior: "smooth" });
    });

    elements.buttonTutupPanduan.addEventListener("click", () => {
        elements.panduanDialog.close();
    });

    elements.buttonPahamiPanduan.addEventListener("click", () => {
        elements.panduanDialog.close();
    });

    elements.panduanDialog.addEventListener("cancel", event => {
        event.preventDefault();
        elements.panduanDialog.close();
    });
}

function validateThread(thread) {
    const fields = [thread.title, thread.summary, thread.category, thread.opd, thread.author];
    return fields.every(value => Boolean(value && value.length >= 3));
}

function buildTags(summary) {
    return summary
        .split(/\s+/)
        .map(word => word.toLowerCase().replace(/[^a-z0-9-]/g, ""))
        .filter(word => word.length > 4)
        .slice(0, 3)
        .map(word => word.substring(0, 16));
}

function formatDate(value) {
    if (!value) {
        return "-";
    }
    const date = new Date(value);
    return new Intl.DateTimeFormat("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric"
    }).format(date);
}

function slugify(value) {
    return value
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/[^a-z0-9]+/g, "-")
        .replace(/(^-|-$)/g, "");
}

function initialize() {
    renderFilters();
    renderStats();
    renderThreads();
    renderTrending();
    renderOpdTeraktif();
    renderUpdates();
    renderAgenda();
    renderAnnouncements();
    renderResources();
    setInsight();
    setupEvents();
    elements.tahunBerjalan.textContent = new Date().getFullYear();
}

document.addEventListener("DOMContentLoaded", initialize);
