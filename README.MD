Lai strādāt ar projektu, vajag lejupielādet mapi htdocs direktorijā
Lejupielādēt Node.js, kas tiek izmantots lai paņemt packages no npmjs.com (packages būs lejupielādetās no npm izmantojot failu package.json, kur glabājas visu izmantotu paķēšu nosaukumi un versijas) 
**Lai lejupielādēt** -> https://nodejs.org/en/download/  -> Priekš windows paņemt Node.js LTS versiju
Lai pārbaudīt vai Node.js un npm ir uzstādīti pareizi konsoles režīmā ievādīt node -v   un   npm -v
Pēc lejupielādēšanas mapes saknē, tur , kur atrodas package.json fails
- atvērt cmd - **command line window** jeb konsoli
- Ievādīt komandu **npm install**, tas ir vajadzījs lai mapes saknē lejupielādēt vajadzīgas paķetes, tās parādīsies mapē node_modules
- Atvērt XAMPP, vai Wampp, vienalga, galvenais ir ieslēgt Apache serveri un MySQL!!!
- Pēc tam, kad būs lejupielādētās paķetes konsolē, tajā pašā vietā uzsrakstīt **npm run dev** - tas startēt tasku, kas sakopos visas paķetes un izveidos mūsu programmas front-end daļu. Skripts tiek paņemts no faila package.json -> "scripts" -> "dev"
- Kad tasks visu izdarīs, atvērsies parlūks ar mūsu vietni
