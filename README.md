# Proof of concept aplikační architektury

Tento repozitář obsahuje ukázku architektury funkční aplikace, která je rozdělená na tři části
- **storage** - jádro systému s aplikační logikou. Komunikuje s okolím skrze REST API
- **storage-sdk** - implementace komunikace s API jádra, pro snadnou integraci služby do projektu
- **storage-admin** - administrační rozhraní pro práci administraci služby. S jádrem systému komunikuje přes REST API za pomocí SDK

## Motivace
Repozitář je strukturovaný jako monorepo. Hlavní motivací je snadný vývoj souvisejících komponent, ale s
jasně vydefinovanýma hranicema. Návrh je zvolen tak, aby bylo hlavní jádro služby co nejvíce odstíněno od vlivu
technologií, které jsou aktuálně módní. Z tohoto důvodu je například administrační rozhraní zcela oddělené, aby
bylo možné jej nahradit jakoukoliv jinou implementací, bez vlivu na jádro systému.

V aktuálním nastavení dochází k při každém releasu nové verze k publikováni změn v SDK do read-only repozitáře.
Díky tomu mohou mít projekty závislost pouze na jednom malém balíčku.

Díky tomu, že administrace používá SDK pro práci s jádrem systému, je tím zaručeno, že SDK bude
funkční a nebudou v něm chyby, což by hrozilo v případě že by se používal pouze na projektu.

Aplikace bude mít vybudované REST API rovnou a bude možné jej použít jak při integraci s třetí stranou obecně
, tak při psaní můstku pro komunikaci s ERP. 

## PoC releasováni
