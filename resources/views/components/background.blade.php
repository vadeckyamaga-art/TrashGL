<div class="bg-picker" id="picker-couleur">
    <button type="button" class="swatch selected" style="background:#FF6A1A" data-bg-type="couleur" data-bg-value="#FF6A1A" aria-label="Orange"></button>
    <button type="button" class="swatch" style="background:#1F6F5C" data-bg-type="couleur" data-bg-value="#1F6F5C" aria-label="Vert sapin"></button>
    <button type="button" class="swatch" style="background:#1B3B6F" data-bg-type="couleur" data-bg-value="#1B3B6F" aria-label="Bleu marine"></button>
    <button type="button" class="swatch" style="background:#6B3FA0" data-bg-type="couleur" data-bg-value="#6B3FA0" aria-label="Violet"></button>
    <button type="button" class="swatch" style="background:#D94F70" data-bg-type="couleur" data-bg-value="#D94F70" aria-label="Rose"></button>
    <button type="button" class="swatch" style="background:#2B2420" data-bg-type="couleur" data-bg-value="#2B2420" aria-label="Charbon"></button>
    <label class="swatch custom-swatch" aria-label="Couleur personnalisée">
        <input type="color" id="custom-color" value="#FF6A1A">
        <i class="fa-solid fa-eye-dropper"></i>
    </label>
</div>

<div class="bg-picker" id="picker-degrade" hidden>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#FF6A1A,#B93F00)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#FF6A1A,#B93F00)" aria-label="Dégradé orange"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#6B3FA0,#2B1655)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#6B3FA0,#2B1655)" aria-label="Dégradé violet"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#1F6F5C,#0B2E27)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#1F6F5C,#0B2E27)" aria-label="Dégradé vert"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#1B3B6F,#0A1B33)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#1B3B6F,#0A1B33)" aria-label="Dégradé bleu"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#D94F70,#7A1F3D)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#D94F70,#7A1F3D)" aria-label="Dégradé rose"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#4A4A4A,#111111)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#4A4A4A,#111111)" aria-label="Dégradé charbon"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#FFD1B5,#4A1F2B)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#FFD1B5,#4A1F2B)" aria-label="Dégradé peche-rosé"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#A8D5E2,#0F2B3D)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#A8D5E2,#0F2B3D)" aria-label="Dégradé cyan-doux"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#C9E4C5,#0D2E1F)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#C9E4C5,#0D2E1F)" aria-label="Dégradé menthe-fraiche"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#E8D5F5,#2A1A3D)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#E8D5F5,#2A1A3D)" aria-label="Dégradé lavande"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#FDF2C2,#2C24A1)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#FDF2C2,#2C24A1)" aria-label="Dégradé doré-clair"></button>
    <button type="button" class="swatch" style="background:linear-gradient(135deg,#FBC4C4,#4A1520)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#FBC4C4,#4A1520)" aria-label="Dégradé corail-pastel"></button>
</div>

<div class="bg-picker gallery" id="picker-image" hidden>
    @foreach ($backgroundImages as $image)
        <button type="button" class="gallery-thumb"
            style="background-image:url('{{ $image->thumbnail_url ?? $image->url }}')"
            data-bg-type="image"
            data-bg-value="{{ $image->url }}"
            data-bg-image-id="{{ $image->id }}"
            aria-label="Image de fond {{ $loop->iteration }}">
        </button>
    @endforeach
</div>
