<div>
    <button wire:click="$emit('changeState', 'received')" class="tablink" id="defaultOpen"
        onclick="changeBackground(this, '#f6c23e')">Received</button>
    <button wire:click="$emit('changeState', 'prepared')" class="tablink"
        onclick="changeBackground(this, '#4e73df')">Prepared</button>
    <button wire:click="$emit('changeState', 'delivered')" class="tablink"
        onclick="changeBackground(this, '#1cc88a')">Delivered</button>
    <button wire:click="$emit('changeState', 'canceled')" class="tablink"
        onclick="changeBackground(this, '#e74a3b')">Canceled</button>

    <div class="tabcontent">
        @livewire('order-component', ['restaurant' => $restaurant])
    </div>

</div>

<script>
    function changeBackground(elmnt, color) {
        // Remove the background color of all tablinks/buttons
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }

        // Add the specific color to the button used to open the tab content
        elmnt.style.backgroundColor = color;
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

</script>
