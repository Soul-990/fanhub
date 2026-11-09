const FANHUB_DATA = {
  // 8 Main Fandom Categories
  categories: [
    {
      id: "anime",
      name: "Anime",
      badgeClass: "badge-anime",
      count: "1,240+ Titles",
      desc: "Top seasonal series, shonen classics, and celebrated studio animations.",
      image: "https://images.unsplash.com/photo-1578632767115-351597cf2477?w=600&auto=format&fit=crop&q=80"
    },
    {
      id: "gaming",
      name: "Gaming",
      badgeClass: "badge-gaming",
      count: "850+ Releases",
      desc: "AAA blockbusters, indie gems, esports coverage, and upcoming RPGs.",
      image: "https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&auto=format&fit=crop&q=80"
    },
    {
      id: "movies",
      name: "Movies",
      badgeClass: "badge-movies",
      count: "920+ Films",
      desc: "Cinematic universes, sci-fi sagas, thrilling blockbusters, and reviews.",
      image: "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=600&auto=format&fit=crop&q=80"
    },
    {
      id: "tv",
      name: "TV Shows",
      badgeClass: "badge-tv",
      count: "640+ Series",
      desc: "Binge-worthy drama, fantasy epics, and trending streaming releases.",
      image: "https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=600&auto=format&fit=crop&q=80"
    },
    {
      id: "kpop",
      name: "K-Pop",
      badgeClass: "badge-kpop",
      count: "410+ Artists",
      desc: "Idol comebacks, concert schedules, lightsticks, and choreography.",
      image: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&auto=format&fit=crop&q=80"
    },
    {
      id: "comics",
      name: "Comics",
      badgeClass: "badge-comics",
      count: "780+ Issues",
      desc: "Marvel, DC, graphic novels, variant covers, and creator highlights.",
      image: "https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=600&auto=format&fit=crop&q=80"
    },
    {
      id: "manga",
      name: "Manga",
      badgeClass: "badge-manga",
      count: "1,150+ Volumes",
      desc: "Weekly chapter drops, manhwa adaptations, and serialized epics.",
      image: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&auto=format&fit=crop&q=80"
    },
    {
      id: "cosplay",
      name: "Cosplay",
      badgeClass: "badge-cosplay",
      count: "360+ Creators",
      desc: "Prop-making tutorials, convention photoshoots, and costume spotlights.",
      image: "https://images.unsplash.com/photo-1563089145-599997674d42?w=600&auto=format&fit=crop&q=80"
    }
  ],

  // 16 Detailed Content Items across Fandoms
  content: [
    {
      id: "c1",
      title: "Attack on Titan: The Final Chapters",
      category: "Anime",
      categoryId: "anime",
      badgeClass: "badge-anime",
      genre: "Action / Dark Fantasy",
      year: 2023,
      type: "Video",
      popularity: 98,
      rating: "9.8 / 10",
      description: "Eren Jaeger's fateful march against humanity reaches its devastating conclusion in the ultimate clash of ideologies and destiny.",
      image: "https://images.unsplash.com/photo-1578632767115-351597cf2477?w=700&auto=format&fit=crop&q=80",
      releaseDate: "November 4, 2023",
      duration: "85 mins",
      featured: true,
      tags: ["Titan", "Shingeki", "Eren", "MAPPA"]
    },
    {
      id: "c2",
      title: "Cyberpunk 2077: Phantom Liberty",
      category: "Gaming",
      categoryId: "gaming",
      badgeClass: "badge-gaming",
      genre: "Sci-Fi RPG",
      year: 2023,
      type: "Article",
      popularity: 95,
      rating: "9.5 / 10",
      description: "Dive into Dogtown with sleeper agent Solomon Reed in this thrilling spy-espionage expansion to CD Projekt RED's night city saga.",
      image: "https://images.unsplash.com/photo-1542751371-adc38448a05e?w=700&auto=format&fit=crop&q=80",
      releaseDate: "September 26, 2023",
      duration: "30+ hrs story",
      featured: true,
      tags: ["Dogtown", "Keanu", "Idris Elba", "RPG"]
    },
    {
      id: "c3",
      title: "Spider-Man: Across the Spider-Verse",
      category: "Movies",
      categoryId: "movies",
      badgeClass: "badge-movies",
      genre: "Animation / Superhero",
      year: 2023,
      type: "Video",
      popularity: 97,
      rating: "9.7 / 10",
      description: "Miles Morales catapults across the Multiverse, where he encounters a team of Spider-People charged with protecting its very existence.",
      image: "https://images.unsplash.com/photo-1635805737707-575885ab0820?w=700&auto=format&fit=crop&q=80",
      releaseDate: "June 2, 2023",
      duration: "140 mins",
      featured: true,
      tags: ["Miles Morales", "Spider-Gwen", "Sony", "Multiverse"]
    },
    {
      id: "c4",
      title: "Stranger Things: Season 5 Sneak Peek",
      category: "TV Shows",
      categoryId: "tv",
      badgeClass: "badge-tv",
      genre: "Supernatural Mystery",
      year: 2024,
      type: "Video",
      popularity: 94,
      rating: "9.4 / 10",
      description: "Hawkins prepares for its ultimate battle against Vecna as the boundary between the Upside Down and reality completely fractures.",
      image: "https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=700&auto=format&fit=crop&q=80",
      releaseDate: "Upcoming 2025",
      duration: "8 Episodes",
      featured: true,
      tags: ["Hawkins", "Eleven", "Upside Down", "Netflix"]
    },
    {
      id: "c5",
      title: "BTS: Yet to Come Global Showcase",
      category: "K-Pop",
      categoryId: "kpop",
      badgeClass: "badge-kpop",
      genre: "Concert Film / Pop",
      year: 2023,
      type: "Audio",
      popularity: 96,
      rating: "9.6 / 10",
      description: "Experience the monumental Busan concert featuring all seven members performing historic anthems with breathtaking choreography.",
      image: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=700&auto=format&fit=crop&q=80",
      releaseDate: "February 1, 2023",
      duration: "103 mins",
      featured: true,
      tags: ["ARMY", "Busan", "Live", "Bangtan"]
    },
    {
      id: "c6",
      title: "Batman: The Dark Knight Returns Definitive Edition",
      category: "Comics",
      categoryId: "comics",
      badgeClass: "badge-comics",
      genre: "Graphic Novel / Noir",
      year: 2022,
      type: "Article",
      popularity: 92,
      rating: "9.3 / 10",
      description: "Frank Miller’s magnum opus reimagines a weathered Bruce Wayne returning to Gotham to wage a brutal war on violent crime.",
      image: "https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=700&auto=format&fit=crop&q=80",
      releaseDate: "October 18, 2022",
      duration: "224 pages",
      featured: true,
      tags: ["DC", "Gotham", "Frank Miller", "Batman"]
    },
    {
      id: "c7",
      title: "Solo Leveling: Arise & Awakening",
      category: "Manga",
      categoryId: "manga",
      badgeClass: "badge-manga",
      genre: "Action / Supernatural",
      year: 2024,
      type: "Image",
      popularity: 99,
      rating: "9.9 / 10",
      description: "Follow Sung Jin-woo, the weakest E-rank hunter, as he discovers an elusive quest window that unlocks limitless ascension power.",
      image: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=700&auto=format&fit=crop&q=80",
      releaseDate: "January 6, 2024",
      duration: "Ongoing",
      featured: true,
      tags: ["Manhwa", "Shadow Monarch", "Hunter", "Webtoon"]
    },
    {
      id: "c8",
      title: "Genshin Impact: Teyvat Cosplay Chronicles",
      category: "Cosplay",
      categoryId: "cosplay",
      badgeClass: "badge-cosplay",
      genre: "Craft & Costume Showcase",
      year: 2024,
      type: "Image",
      popularity: 91,
      rating: "9.2 / 10",
      description: "Master craftspeople demonstrate how Fontaine armor, illuminated weapons, and intricate silicone makeup are brought to life.",
      image: "https://images.unsplash.com/photo-1563089145-599997674d42?w=700&auto=format&fit=crop&q=80",
      releaseDate: "March 15, 2024",
      duration: "Gallery Feature",
      featured: true,
      tags: ["HoYoverse", "Fontaine", "Props", "Crafting"]
    },
    {
      id: "c9",
      title: "Elden Ring: Shadow of the Erdtree",
      category: "Gaming",
      categoryId: "gaming",
      badgeClass: "badge-gaming",
      genre: "Action RPG / Dark Fantasy",
      year: 2024,
      type: "Video",
      popularity: 98,
      rating: "9.9 / 10",
      description: "Guided by Empyrean Miquella, players step into the Realm of Shadow to uncover dark secrets and face harrowing new demigods.",
      image: "https://images.unsplash.com/photo-1511512578047-dfb367046420?w=700&auto=format&fit=crop&q=80",
      releaseDate: "June 21, 2024",
      duration: "40+ hrs",
      featured: false,
      tags: ["FromSoftware", "Miquella", "Souls", "Erdtree"]
    },
    {
      id: "c10",
      title: "Jujutsu Kaisen: Shibuya Incident Arc",
      category: "Anime",
      categoryId: "anime",
      badgeClass: "badge-anime",
      genre: "Supernatural / Action",
      year: 2023,
      type: "Video",
      popularity: 97,
      rating: "9.7 / 10",
      description: "On Halloween night, cursed spirits led by Pseudo-Geto launch an unprecedented assault in Shibuya to seal Satoru Gojo.",
      image: "https://images.unsplash.com/photo-1534447677768-be436bb09401?w=700&auto=format&fit=crop&q=80",
      releaseDate: "August 31, 2023",
      duration: "18 Episodes",
      featured: false,
      tags: ["Gojo", "Sukuna", "MAPPA", "Shibuya"]
    },
    {
      id: "c11",
      title: "The Last of Us: Season 2 Production Notes",
      category: "TV Shows",
      categoryId: "tv",
      badgeClass: "badge-tv",
      genre: "Post-Apocalyptic Drama",
      year: 2024,
      type: "Article",
      popularity: 93,
      rating: "9.4 / 10",
      description: "An insider look into Joel and Ellie's harrowing path forward as the consequences of Jackson catch up with unyielding fury.",
      image: "https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=700&auto=format&fit=crop&q=80",
      releaseDate: "Upcoming 2025",
      duration: "Deep Dive",
      featured: false,
      tags: ["HBO", "Pedro Pascal", "Bella Ramsey", "Naughty Dog"]
    },
    {
      id: "c12",
      title: "Oppenheimer: The Cinematic Odyssey",
      category: "Movies",
      categoryId: "movies",
      badgeClass: "badge-movies",
      genre: "Biographical Drama",
      year: 2023,
      type: "Article",
      popularity: 96,
      rating: "9.6 / 10",
      description: "Christopher Nolan explores the triumph and tragedy of J. Robert Oppenheimer as the atomic bomb reshapes the fate of the earth.",
      image: "https://images.unsplash.com/photo-1440404653325-ab127d49abc1?w=700&auto=format&fit=crop&q=80",
      releaseDate: "July 21, 2023",
      duration: "180 mins",
      featured: false,
      tags: ["Nolan", "IMAX", "Oscar Winner", "Atomic"]
    },
    {
      id: "c13",
      title: "BLACKPINK: Born Pink World Tour Live Album",
      category: "K-Pop",
      categoryId: "kpop",
      badgeClass: "badge-kpop",
      genre: "Dance / Trap Pop",
      year: 2023,
      type: "Audio",
      popularity: 94,
      rating: "9.3 / 10",
      description: "Electrifying live band renditions of 'Pink Venom', 'Shut Down', and legendary stadium solos recorded across 34 global cities.",
      image: "https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=700&auto=format&fit=crop&q=80",
      releaseDate: "October 6, 2023",
      duration: "24 Tracks",
      featured: false,
      tags: ["BLINK", "Jennie", "Lisa", "Rose", "Jisoo"]
    },
    {
      id: "c14",
      title: "One Piece: Egghead Island Arc",
      category: "Manga",
      categoryId: "manga",
      badgeClass: "badge-manga",
      genre: "Adventure / Fantasy",
      year: 2024,
      type: "Article",
      popularity: 99,
      rating: "9.9 / 10",
      description: "The Straw Hat Pirates arrive at Dr. Vegapunk's futuristic scientific island, unraveling secrets of the Void Century and Ancient Kingdom.",
      image: "https://images.unsplash.com/photo-1569003339405-ea396a5a8a90?w=700&auto=format&fit=crop&q=80",
      releaseDate: "Weekly Serialization",
      duration: "Ongoing",
      featured: false,
      tags: ["Luffy", "Gear 5", "Oda", "Shonen Jump"]
    },
    {
      id: "c15",
      title: "X-Men '97: Rebirth of an Era",
      category: "Comics",
      categoryId: "comics",
      badgeClass: "badge-comics",
      genre: "Superhero / Drama",
      year: 2024,
      type: "Video",
      popularity: 95,
      rating: "9.5 / 10",
      description: "Continuing the beloved 90s animated saga with Magneto taking leadership of Xavier's school amid escalating mutant tensions.",
      image: "https://images.unsplash.com/photo-1534447677768-be436bb09401?w=700&auto=format&fit=crop&q=80",
      releaseDate: "March 20, 2024",
      duration: "10 Episodes",
      featured: false,
      tags: ["Cyclops", "Magneto", "Mutants", "Marvel"]
    },
    {
      id: "c16",
      title: "Cyberpunk Edge: Neon Armor & LEDs",
      category: "Cosplay",
      categoryId: "cosplay",
      badgeClass: "badge-cosplay",
      genre: "Wearable Electronics",
      year: 2023,
      type: "Image",
      popularity: 90,
      rating: "9.0 / 10",
      description: "A comprehensive guide to micro-controller programmed RGB lighting, transparent visors, and lightweight EVA foam armor crafting.",
      image: "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=700&auto=format&fit=crop&q=80",
      releaseDate: "November 12, 2023",
      duration: "Maker Series",
      featured: false,
      tags: ["Arduino", "EVA Foam", "Cyberpunk", "Tutorial"]
    }
  ],

  // 8 Character Profiles
  characters: [
    {
      id: "char-1",
      name: "Satoru Gojo",
      fandom: "Jujutsu Kaisen (Anime)",
      categoryId: "anime",
      badgeClass: "badge-anime",
      role: "Special Grade Sorcerer",
      description: "The strongest jujutsu sorcerer alive, known for his Boundless Infinity technique and charismatic demeanor.",
      image: "https://images.unsplash.com/photo-1578632767115-351597cf2477?w=500&auto=format&fit=crop&q=80"
    },
    {
      id: "char-2",
      name: "Geralt of Rivia",
      fandom: "The Witcher (Gaming)",
      categoryId: "gaming",
      badgeClass: "badge-gaming",
      role: "Monster Slayer of the Wolf School",
      description: "A stoic mutated hunter wandering the Continent, balancing silver swords with gray moral conflicts.",
      image: "https://images.unsplash.com/photo-1542751371-adc38448a05e?w=500&auto=format&fit=crop&q=80"
    },
    {
      id: "char-3",
      name: "Miles Morales",
      fandom: "Spider-Man (Movies/Comics)",
      categoryId: "movies",
      badgeClass: "badge-movies",
      role: "Brooklyn's Spider-Man",
      description: "Equipped with venom blast shocks and camouflage, Miles balances high school with saving multiverse realities.",
      image: "https://images.unsplash.com/photo-1635805737707-575885ab0820?w=500&auto=format&fit=crop&q=80"
    },
    {
      id: "char-4",
      name: "Wednesday Addams",
      fandom: "Wednesday (TV Shows)",
      categoryId: "tv",
      badgeClass: "badge-tv",
      role: "Nevermore Academy Detective",
      description: "A razor-witted gothic prodigy solving ancestral mysteries while investigating local paranormal murders.",
      image: "https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=500&auto=format&fit=crop&q=80"
    },
    {
      id: "char-5",
      name: "Lalisa Manobal",
      fandom: "BLACKPINK (K-Pop)",
      categoryId: "kpop",
      badgeClass: "badge-kpop",
      role: "Lead Rapper & Dancer",
      description: "Global fashion icon and hip-hop performer celebrated worldwide for explosive stage presence and record-breaking solos.",
      image: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=80"
    },
    {
      id: "char-6",
      name: "Sung Jin-woo",
      fandom: "Solo Leveling (Manga)",
      categoryId: "manga",
      badgeClass: "badge-manga",
      role: "Shadow Monarch",
      description: "Transforming from the world's weakest hunter into an army-commanding sovereign capable of raising fallen foes.",
      image: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=500&auto=format&fit=crop&q=80"
    },
    {
      id: "char-7",
      name: "Bruce Wayne / Batman",
      fandom: "DC Universe (Comics)",
      categoryId: "comics",
      badgeClass: "badge-comics",
      role: "The Dark Knight",
      description: "Billionaire philanthropist by day and Gotham's relentless guardian by night, armed with intellect and gadgetry.",
      image: "https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=500&auto=format&fit=crop&q=80"
    },
    {
      id: "char-8",
      name: "Marin Kitagawa",
      fandom: "My Dress-Up Darling (Cosplay/Anime)",
      categoryId: "cosplay",
      badgeClass: "badge-cosplay",
      role: "Cosplay Enthusiast",
      description: "A spirited otaku high-schooler passionate about transforming into beloved anime and gaming heroes through craft.",
      image: "https://images.unsplash.com/photo-1563089145-599997674d42?w=500&auto=format&fit=crop&q=80"
    }
  ],

  // 6 Featured Articles
  articles: [
    {
      id: "art-1",
      title: "Why 2024 Is Crowned The Golden Age of Dark Fantasy Anime",
      category: "Anime",
      badgeClass: "badge-anime",
      date: "September 18, 2024",
      author: "Hassan Ali",
      readTime: "5 min read",
      summary: "From Jujutsu Kaisen to Chainsaw Man, mature animation themes are breaking international streaming records.",
      image: "https://images.unsplash.com/photo-1578632767115-351597cf2477?w=600&auto=format&fit=crop&q=80",
      content: "Over the past three years, dark fantasy has decisively taken over prime anime broadcasting slots. Rather than simple escapism, modern audiences resonate with high stakes, complex gray morality, and cinematic combat sequences handled by trailblazing animation teams like MAPPA and ufotable. This article explores the cultural shift, production budgets, and how streaming platforms have broadened the demographic."
    },
    {
      id: "art-2",
      title: "The Evolution of Open-World RPG Storytelling in Modern Gaming",
      category: "Gaming",
      badgeClass: "badge-gaming",
      date: "September 12, 2024",
      author: "Zainab Malik",
      readTime: "7 min read",
      summary: "How titles like Elden Ring and Cyberpunk 2077 discarded map checklists for organic discovery.",
      image: "https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&auto=format&fit=crop&q=80",
      content: "For over a decade, open-world design was dominated by quest markers and busy mini-maps. However, recent blockbuster titles demonstrated that players hunger for environmental storytelling and player agency. By trusting gamers to explore landmarks naturally and piece together lore through architecture and dialogue, developers have revived genuine awe in game exploration."
    },
    {
      id: "art-3",
      title: "Multiverse Fatigue vs. Multiverse Mastery: A Film Retrospective",
      category: "Movies",
      badgeClass: "badge-movies",
      date: "August 29, 2024",
      author: "Farhan Siddiqui",
      readTime: "6 min read",
      summary: "Analyzing why Spider-Verse captivated worldwide audiences while other dimensional storylines faltered.",
      image: "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=600&auto=format&fit=crop&q=80",
      content: "The multiverse has become Hollywood's favorite storytelling mechanism, but its execution varies wildly. When used merely for fan service cameos, audiences disengage. But when anchored by deeply personal emotional stakes—such as Miles Morales challenging the deterministic nature of his destiny—multiversal worlds become an irresistible metaphor for personal choice and family identity."
    },
    {
      id: "art-4",
      title: "K-Pop 5th Generation: Rising Trends, Concepts, and Soundscapes",
      category: "K-Pop",
      badgeClass: "badge-kpop",
      date: "August 15, 2024",
      author: "Amina Tariq",
      readTime: "4 min read",
      summary: "New girl groups and boy groups are mixing Y2K nostalgia with UK garage beats to dominate TikTok charts.",
      image: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&auto=format&fit=crop&q=80",
      content: "The fifth generation of K-Pop is characterized by effortless 'easy-listening' grooves, retro millennium aesthetics, and direct fan engagement through short-form video. Agencies have shifted away from heavily lore-laden storylines in favor of breezy hooks, drum-and-bass tempos, and relatable coming-of-age concepts that have expanded K-pop's global footprint."
    },
    {
      id: "art-5",
      title: "Beginner’s Guide to 3D Printing and Crafting Armor for Cosplay",
      category: "Cosplay",
      badgeClass: "badge-cosplay",
      date: "July 24, 2024",
      author: "Bilal Raza",
      readTime: "8 min read",
      summary: "Everything you need to know about PLA filaments, heat-gun shaping, primer sanding, and weathering paints.",
      image: "https://images.unsplash.com/photo-1563089145-599997674d42?w=600&auto=format&fit=crop&q=80",
      content: "Stepping into cosplay prop building can feel intimidating with so many materials available. This primer walks through affordable entry-level tools: choosing between high-density EVA foam and entry-level FDM 3D printers, safety precautions with contact cement, sealing techniques, and dry-brushing secrets that give plain plastic an authentic hammered-steel appearance."
    },
    {
      id: "art-6",
      title: "The Rise of Webtoons and Manhwa in Global Mainstream Entertainment",
      category: "Manga",
      badgeClass: "badge-manga",
      date: "July 10, 2024",
      author: "Sara Khan",
      readTime: "5 min read",
      summary: "Vertical scrolling digital comics from South Korea are quickly becoming Hollywood's favorite adaptation source.",
      image: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&auto=format&fit=crop&q=80",
      content: "Smartphone vertical reading fundamentally transformed comic pacing. Today, millions of daily active readers devour weekly chapters on digital apps. With major studios securing rights to leading action and romance titles, manhwa is setting the benchmark for 21st-century visual storytelling."
    }
  ],

  // 8 Media Center Items
  media: [
    {
      id: "med-1",
      title: "Elden Ring: Shadow of the Erdtree Official Trailer",
      type: "trailers",
      typeLabel: "Official Trailer",
      duration: "3:05",
      image: "https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&auto=format&fit=crop&q=80",
      description: "Cinematic reveal trailer showcasing the Land of Shadow, Messmer the Impaler, and breathtaking landscapes."
    },
    {
      id: "med-2",
      title: "Demon Slayer: Infinity Castle Arc Announcement",
      type: "videos",
      typeLabel: "Teaser Video",
      duration: "1:45",
      image: "https://images.unsplash.com/photo-1578632767115-351597cf2477?w=600&auto=format&fit=crop&q=80",
      description: "ufotable presents the three-part film spectacle heralding the climactic showdown against Muzan Kibutsuji."
    },
    {
      id: "med-3",
      title: "Fandom Lofi Beats: Cyberpunk & Neon Rain",
      type: "audio",
      typeLabel: "Original Soundtrack / Audio",
      duration: "2:40",
      audioSrc: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3",
      image: "https://images.unsplash.com/photo-1518709268805-4e9042af9f23?w=600&auto=format&fit=crop&q=80",
      description: "Relaxing atmospheric synthwave audio track composed for late-night gaming and manga reading sessions."
    },
    {
      id: "med-4",
      title: "K-Pop Instrumental: Acoustic Showcase",
      type: "audio",
      typeLabel: "Audio Melody",
      duration: "3:12",
      audioSrc: "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3",
      image: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&auto=format&fit=crop&q=80",
      description: "Gentle piano and guitar instrumental interpretation of modern K-pop ballad arrangements."
    },
    {
      id: "med-5",
      title: "Dune Part Two: Behind the Sandworms VFX",
      type: "videos",
      typeLabel: "Behind The Scenes",
      duration: "8:20",
      image: "https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=600&auto=format&fit=crop&q=80",
      description: "Director Denis Villeneuve breaks down the practical rig work and CGI blending that crafted Arrakis."
    },
    {
      id: "med-6",
      title: "Spider-Verse Multi-Style Animation Reel",
      type: "trailers",
      typeLabel: "Animation Reel",
      duration: "4:15",
      image: "https://images.unsplash.com/photo-1635805737707-575885ab0820?w=600&auto=format&fit=crop&q=80",
      description: "A spotlight on the watercolors of Earth-65 and the futuristic Indian aesthetic of Mumbattan."
    },
    {
      id: "med-7",
      title: "Neo-Tokyo 4K Fandom Wallpaper Collection",
      type: "images",
      typeLabel: "Digital Art & Wallpaper",
      duration: "High-Res Gallery",
      image: "https://images.unsplash.com/photo-1509198397868-475647b2a1e5?w=600&auto=format&fit=crop&q=80",
      description: "Curated collection of vibrant cyberpunk cityscapes and character fan art in 3840x2160."
    },
    {
      id: "med-8",
      title: "Comic Con Cosplay Photography Showcase",
      type: "images",
      typeLabel: "Photo Gallery",
      duration: "18 Photos",
      image: "https://images.unsplash.com/photo-1563089145-599997674d42?w=600&auto=format&fit=crop&q=80",
      description: "High-contrast studio portraits captured live on the convention floor across international fan gatherings."
    }
  ],

  // 6 Events
  events: [
    {
      id: "ev-1",
      name: "Pak-Anime & Gaming Expo 2024",
      date: "October 14-16, 2024",
      city: "Karachi",
      venue: "Karachi Expo Centre, Hall 2",
      type: "Convention & Esports",
      badgeClass: "badge-anime",
      description: "Pakistan's premier convention featuring Tekken tournaments, cosplay runway, artist alley, and manga vendors."
    },
    {
      id: "ev-2",
      name: "Lahore Comic & Pop Culture Con",
      date: "November 5-6, 2024",
      city: "Lahore",
      venue: "Alhamra Arts Council, Mall Road",
      type: "Pop Culture Meetup",
      badgeClass: "badge-comics",
      description: "Gathering comic collectors, indie comic illustrators, tabletop gamers, and sci-fi enthusiasts."
    },
    {
      id: "ev-3",
      name: "Islamabad Cosplay & K-Pop Festival",
      date: "December 2, 2024",
      city: "Islamabad",
      venue: "Pak-China Friendship Centre",
      type: "Music & Cosplay",
      badgeClass: "badge-kpop",
      description: "Live dance cover battles, random dance play, lightstick celebrations, and handmade prop competitions."
    },
    {
      id: "ev-4",
      name: "Tokyo Game Show 2024",
      date: "September 26-29, 2024",
      city: "Tokyo",
      venue: "Makuhari Messe, Chiba",
      type: "Global Expo",
      badgeClass: "badge-gaming",
      description: "Japan's flagship video game convention showcasing upcoming JRPGs, hardware, and developer panels."
    },
    {
      id: "ev-5",
      name: "Seoul Global K-Pop Wave Summit",
      date: "October 22, 2024",
      city: "Seoul",
      venue: "Olympic Gymnastics Arena (KSPO Dome)",
      type: "Concert & Awards",
      badgeClass: "badge-kpop",
      description: "An unforgettable celebration of Korean pop culture, international fans, and live performances."
    },
    {
      id: "ev-6",
      name: "New York Comic Con 2024",
      date: "October 17-20, 2024",
      city: "New York",
      venue: "Javits Center, Manhattan",
      type: "Mega Convention",
      badgeClass: "badge-movies",
      description: "East Coast’s largest pop culture event hosting Hollywood trailer drops, celebrity signings, and comic premieres."
    }
  ],

  // 8 Merchandise Showcase Items (NO CART / NO CHECKOUT)
  merchandise: [
    {
      id: "m-1",
      name: "Gojo Satoru Hollow Purple 1/7 Scale Figure",
      fandom: "Jujutsu Kaisen",
      categoryId: "anime",
      tag: "Limited Edition",
      tagClass: "bg-danger",
      image: "https://images.unsplash.com/photo-1578632767115-351597cf2477?w=600&auto=format&fit=crop&q=80",
      description: "Intricately sculpted PVC statue capturing the iconic cursed technique with translucent effect parts."
    },
    {
      id: "m-2",
      name: "Cyberpunk 2077 Samurai Bomber Jacket",
      fandom: "Cyberpunk 2077",
      categoryId: "gaming",
      tag: "Collectible",
      tagClass: "bg-warning text-dark",
      image: "https://images.unsplash.com/photo-1542751371-adc38448a05e?w=600&auto=format&fit=crop&q=80",
      description: "Authentic replica flight jacket featuring high-collar LED illumination wiring and embroidered back patch."
    },
    {
      id: "m-3",
      name: "Spider-Man 2099 Miguel O'Hara Variant Comic",
      fandom: "Marvel Comics",
      categoryId: "comics",
      tag: "Limited Edition",
      tagClass: "bg-danger",
      image: "https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?w=600&auto=format&fit=crop&q=80",
      description: "Foil-embossed virgin variant cover issue #1, certified high grade for comic book preservationists."
    },
    {
      id: "m-4",
      name: "Official K-Pop Concert Bluetooth Lightstick",
      fandom: "K-Pop",
      categoryId: "kpop",
      tag: "Upcoming",
      tagClass: "bg-info text-dark",
      image: "https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&auto=format&fit=crop&q=80",
      description: "Interactive stadium-synchronized cheering wand with multi-color LED mapping and mobile app pairing."
    },
    {
      id: "m-5",
      name: "Elden Ring Dark Moon Greatsword Steel Replica",
      fandom: "Elden Ring",
      categoryId: "gaming",
      tag: "Collectible",
      tagClass: "bg-warning text-dark",
      image: "https://images.unsplash.com/photo-1511512578047-dfb367046420?w=600&auto=format&fit=crop&q=80",
      description: "Display-grade stainless steel blade etched with Ranni's lunar blessing runes, mounted on timber plaque."
    },
    {
      id: "m-6",
      name: "Solo Leveling Shadow Daggers Collector's Set",
      fandom: "Solo Leveling",
      categoryId: "manga",
      tag: "Collectible",
      tagClass: "bg-warning text-dark",
      image: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=600&auto=format&fit=crop&q=80",
      description: "Matte black zinc alloy display blades with custom wooden chest lined in purple velvet."
    },
    {
      id: "m-7",
      name: "Cosplay Pro Dual-Temp Heat Gun & Tool Kit",
      fandom: "Cosplay",
      categoryId: "cosplay",
      tag: "Upcoming",
      tagClass: "bg-info text-dark",
      image: "https://images.unsplash.com/photo-1563089145-599997674d42?w=600&auto=format&fit=crop&q=80",
      description: "Precision thermal shaping kit tailored for curving 2mm-10mm high density EVA foam and worbla armor."
    },
    {
      id: "m-8",
      name: "Stranger Things Hellfire Club Vintage Tee",
      fandom: "Stranger Things",
      categoryId: "tv",
      tag: "Collectible",
      tagClass: "bg-warning text-dark",
      image: "https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=600&auto=format&fit=crop&q=80",
      description: "100% heavyweight distressed cotton baseball tee with raglan sleeves and official Hawkins High insignia."
    }
  ]
};

// BookMark Card I think

    // <div class="col-sm-6 col-lg-3 d-flex">
    //   <div class="fanhub-card w-100">
    //     <div class="card-img-wrapper">
    //       <img src="${item.image}" alt="${item.title}" loading="lazy">
    //       <div class="position-absolute top-0 start-0 m-2">
    //         <span class="badge ${item.badgeClass} badge-category">${item.category}</span>
    //       </div>
    //       <div class="position-absolute top-0 end-0 m-2">
    //         <button class="btn-bookmark ${bookmarkedClass}" 
    //                 data-bookmark-id="${item.id}" 
    //                 data-bookmark-title="${item.title.replace(/"/g, '&quot;')}"
    //                 title="${isSaved ? 'Remove bookmark' : 'Bookmark this item'}"
    //                 aria-label="Bookmark ${item.title}">
    //           <i class="bi ${bookmarkIcon}"></i>
    //         </button>
    //       </div>
    //       <div class="position-absolute bottom-0 start-0 w-100 p-2" style="background: linear-gradient(to top, rgba(0,0,0,0.65), transparent);">
    //         <span class="badge bg-white text-dark shadow-sm small fw-semibold">
    //           <i class="bi bi-star-fill text-warning"></i> ${item.rating}
    //         </span>
    //         <span class="badge bg-white text-dark shadow-sm small ms-1 fw-semibold">
    //           ${item.year}
    //         </span>
    //       </div>
    //     </div>
    //     <div class="card-body">
    //       <h5 class="card-title text-truncate" title="${item.title}">${item.title}</h5>
    //       <p class="card-text small">${item.description}</p>
    //       <div class="mt-auto pt-2 border-top border-light-subtle d-flex justify-content-between align-items-center">
    //         <span class="text-muted small fw-medium">${item.genre.split('/')[0]}</span>
    //         <a href="content.html?id=${item.id}" class="btn btn-sm btn-surface">
    //           Explore <i class="bi bi-arrow-right ms-1 text-success"></i>
    //         </a>
    //       </div>
    //     </div>
    //   </div>
    // </div>

// =============================================================================
// 6. GLOBAL EVENT DELEGATION (BOOKMARKS, SHARE, RECENT)
// =============================================================================

function setupGlobalEventListeners() {
  // Delegate bookmark button clicks anywhere on the document
  document.addEventListener("click", (e) => {
    const bookmarkBtn = e.target.closest("[data-bookmark-id]");
    if (bookmarkBtn) {
      e.preventDefault();
      e.stopPropagation();
      const id = bookmarkBtn.getAttribute("data-bookmark-id");
      const title = bookmarkBtn.getAttribute("data-bookmark-title") || "Item";
      BookmarkManager.toggle(id, title);
    }
  });

  // Delegate Share button clicks
  document.addEventListener("click", (e) => {
    const shareBtn = e.target.closest(".btn-share-link");
    if (shareBtn) {
      e.preventDefault();
      if (navigator.clipboard) {
        navigator.clipboard.writeText(window.location.href).then(() => {
          showToast("Link copied to clipboard! Share it with fellow fans.", "success");
        }).catch(() => {
          showToast("Link: " + window.location.href, "info");
        });
      } else {
        showToast("Link: " + window.location.href, "info");
      }
    }
  });
}

// =============================================================================
// 7. INITIALIZE ON DOM READY
// =============================================================================

document.addEventListener("DOMContentLoaded", () => {
  BookmarkManager.updateBadges();
  BookmarkManager.syncButtonStates();
  initGlobalSearch();
  setupGlobalEventListeners();
});
