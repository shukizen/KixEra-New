<!-- Main Content -->
<main class="flex-1 lg:ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <!-- Left: Title -->
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-semibold text-gray-800">Helpdesk</h1>
                <div class="bg-emerald-100 px-4 py-1 rounded-full">
                    <span class="text-emerald-700 text-sm font-medium" id="totalBadge"><?= $stats['total'] ?> Total Ticket</span>
                </div>
            </div>

            <!-- Right: Search -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full md:w-auto">
                <div class="relative flex-1 md:w-80">
                    <input type="text" id="searchInput" placeholder="Cari subject atau email..."
                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-xl text-gray-600 focus:outline-none focus:border-emerald-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <!-- Total -->
            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-ticket-alt text-emerald-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total</p>
                        <h3 class="text-xl font-bold text-emerald-600" id="stat-total"><?= $stats['total'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Open -->
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-envelope-open text-blue-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Open</p>
                        <h3 class="text-xl font-bold text-blue-600" id="stat-open"><?= $stats['open'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- In Progress -->
            <div class="bg-white rounded-2xl shadow-lg border border-yellow-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-spinner text-yellow-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Proses</p>
                        <h3 class="text-xl font-bold text-yellow-600" id="stat-progress"><?= $stats['in_progress'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Resolved -->
            <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Resolved</p>
                        <h3 class="text-xl font-bold text-green-600" id="stat-resolved"><?= $stats['resolved'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Closed -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-times-circle text-gray-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Closed</p>
                        <h3 class="text-xl font-bold text-gray-600" id="stat-closed"><?= $stats['closed'] ?></h3>
                    </div>
                </div>
            </div>

            <!-- Urgent -->
            <div class="bg-white rounded-2xl shadow-lg border border-red-100 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Urgent</p>
                        <h3 class="text-xl font-bold text-red-600" id="stat-urgent"><?= $stats['urgent'] ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Ticket List -->
        <div class="bg-white rounded-2xl shadow-lg mb-6">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex flex-wrap -mb-px px-6">
                    <button onclick="filterByTab('all')" id="tab-all"
                        class="tab-button py-4 px-6 border-b-2 border-emerald-500 text-emerald-600 font-medium text-sm">
                        Semua
                    </button>
                    <button onclick="filterByTab('open')" id="tab-open"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Open
                    </button>
                    <button onclick="filterByTab('in_progress')" id="tab-in_progress"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        In Progress
                    </button>
                    <button onclick="filterByTab('resolved')" id="tab-resolved"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Resolved
                    </button>
                    <button onclick="filterByTab('closed')" id="tab-closed"
                        class="tab-button py-4 px-6 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        Closed
                    </button>
                </nav>
            </div>

            <!-- Ticket Table -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="border-b border-gray-200">
                            <tr>
                                <th class="text-left py-3 px-4 text-gray-600 font-medium text-sm">ID</th>
                                <th class="text-left py-3 px-4 text-gray-600 font-medium text-sm">Subject</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">User</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Kategori</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Prioritas</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Status</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Tanggal</th>
                                <th class="text-center py-3 px-4 text-gray-600 font-medium text-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ticketTableBody">
                            <?php if (!empty($tickets)): ?>
                                <?php foreach ($tickets as $ticket): ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-700">#<?= $ticket->id_ticket ?></td>
                                    <td class="py-3 px-4">
                                        <div class="font-medium text-gray-800"><?= htmlspecialchars($ticket->subject) ?></div>
                                        <div class="text-xs text-gray-500"><?= $ticket->total_messages ?> pesan</div>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="text-sm text-gray-800"><?= $ticket->username ?? '-' ?></div>
                                        <div class="text-xs text-gray-500"><?= $ticket->email ?? '' ?></div>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full capitalize"><?= $ticket->kategori ?></span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <?php
                                        $prioritasColors = [
                                            'rendah' => 'bg-gray-100 text-gray-700',
                                            'sedang' => 'bg-blue-100 text-blue-700',
                                            'tinggi' => 'bg-orange-100 text-orange-700',
                                            'urgent' => 'bg-red-100 text-red-700'
                                        ];
                                        $pColor = $prioritasColors[$ticket->prioritas] ?? 'bg-gray-100 text-gray-700';
                                        ?>
                                        <span class="px-2 py-1 <?= $pColor ?> text-xs rounded-full capitalize"><?= $ticket->prioritas ?></span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <?php
                                        $statusColors = [
                                            'open' => 'bg-blue-100 text-blue-700',
                                            'in_progress' => 'bg-yellow-100 text-yellow-700',
                                            'resolved' => 'bg-green-100 text-green-700',
                                            'closed' => 'bg-gray-100 text-gray-700'
                                        ];
                                        $sColor = $statusColors[$ticket->status] ?? 'bg-gray-100 text-gray-700';
                                        ?>
                                        <span class="px-2 py-1 <?= $sColor ?> text-xs rounded-full capitalize"><?= str_replace('_', ' ', $ticket->status) ?></span>
                                    </td>
                                    <td class="py-3 px-4 text-center text-sm text-gray-600"><?= date('d M Y', strtotime($ticket->created_at)) ?></td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="viewTicket(<?= $ticket->id_ticket ?>)" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition" title="Lihat">
                                                <i class="fas fa-eye text-sm"></i>
                                            </button>
                                            <button onclick="deleteTicket(<?= $ticket->id_ticket ?>)" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition" title="Hapus">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                                            <p>Belum ada ticket</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- View Ticket Modal -->
<div id="viewModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4 max-h-[90vh] overflow-hidden flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b">
            <div>
                <h3 class="text-xl font-semibold text-gray-800" id="viewTitle">Detail Ticket</h3>
                <p class="text-sm text-gray-500" id="viewSubject"></p>
            </div>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Ticket Info -->
        <div class="px-6 py-4 bg-gray-50 border-b flex flex-wrap gap-4">
            <div>
                <span class="text-xs text-gray-500">Status</span>
                <div id="viewStatus"></div>
            </div>
            <div>
                <span class="text-xs text-gray-500">Prioritas</span>
                <div id="viewPrioritas"></div>
            </div>
            <div>
                <span class="text-xs text-gray-500">Kategori</span>
                <div id="viewKategori"></div>
            </div>
            <div>
                <span class="text-xs text-gray-500">User</span>
                <div id="viewUser" class="text-sm font-medium"></div>
            </div>
        </div>
        
        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-6" id="messagesContainer">
            <!-- Messages will be loaded here -->
        </div>
        
        <!-- Reply Form -->
        <div class="p-6 border-t">
            <div class="flex gap-3">
                <select id="statusSelect" class="px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500">
                    <option value="">Ubah Status</option>
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                </select>
                <button onclick="updateStatus()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200">
                    <i class="fas fa-save"></i>
                </button>
            </div>
            <div class="flex gap-3 mt-3">
                <textarea id="replyMessage" rows="2" placeholder="Ketik balasan..." class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:border-emerald-500 resize-none"></textarea>
                <button onclick="sendReply()" class="px-6 py-2 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-trash text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Ticket</h3>
            <p class="text-gray-600">Apakah Anda yakin ingin menghapus ticket ini? Semua pesan akan ikut dihapus.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 bg-gray-100 text-gray-700 px-4 py-3 rounded-xl hover:bg-gray-200 transition font-medium">
                Batal
            </button>
            <button onclick="confirmDelete()" class="flex-1 bg-red-500 text-white px-4 py-3 rounded-xl hover:bg-red-600 transition font-medium">
                <i class="fas fa-trash mr-2"></i>Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
const BASE_URL = '<?= base_url() ?>';
let currentFilter = { status: '', search: '' };
let currentTicketId = null;

$(document).ready(function() {
    setupEventListeners();
});

function setupEventListeners() {
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentFilter.search = $('#searchInput').val();
            loadTickets();
        }, 300);
    });
}

function filterByTab(tab) {
    $('.tab-button').removeClass('border-emerald-500 text-emerald-600').addClass('border-transparent text-gray-500');
    $('#tab-' + tab).removeClass('border-transparent text-gray-500').addClass('border-emerald-500 text-emerald-600');
    
    currentFilter.status = tab === 'all' ? '' : tab;
    loadTickets();
}

function loadTickets() {
    $.ajax({
        url: BASE_URL + 'admin/helpdesk/get_tickets',
        type: 'GET',
        data: currentFilter,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                updateTable(response.data);
            }
        }
    });
}

function updateTable(tickets) {
    let html = '';
    
    if (tickets.length > 0) {
        const prioritasColors = {
            'rendah': 'bg-gray-100 text-gray-700',
            'sedang': 'bg-blue-100 text-blue-700',
            'tinggi': 'bg-orange-100 text-orange-700',
            'urgent': 'bg-red-100 text-red-700'
        };
        
        const statusColors = {
            'open': 'bg-blue-100 text-blue-700',
            'in_progress': 'bg-yellow-100 text-yellow-700',
            'resolved': 'bg-green-100 text-green-700',
            'closed': 'bg-gray-100 text-gray-700'
        };
        
        tickets.forEach(ticket => {
            const pColor = prioritasColors[ticket.prioritas] || 'bg-gray-100 text-gray-700';
            const sColor = statusColors[ticket.status] || 'bg-gray-100 text-gray-700';
            const date = new Date(ticket.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'});
            
            html += `
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4 text-gray-700">#${ticket.id_ticket}</td>
                    <td class="py-3 px-4">
                        <div class="font-medium text-gray-800">${ticket.subject}</div>
                        <div class="text-xs text-gray-500">${ticket.total_messages} pesan</div>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="text-sm text-gray-800">${ticket.username || '-'}</div>
                        <div class="text-xs text-gray-500">${ticket.email || ''}</div>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full capitalize">${ticket.kategori}</span>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <span class="px-2 py-1 ${pColor} text-xs rounded-full capitalize">${ticket.prioritas}</span>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <span class="px-2 py-1 ${sColor} text-xs rounded-full capitalize">${ticket.status.replace('_', ' ')}</span>
                    </td>
                    <td class="py-3 px-4 text-center text-sm text-gray-600">${date}</td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="viewTicket(${ticket.id_ticket})" class="w-8 h-8 bg-emerald-100 hover:bg-emerald-200 text-emerald-600 rounded-lg flex items-center justify-center transition">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                            <button onclick="deleteTicket(${ticket.id_ticket})" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
    } else {
        html = `<tr><td colspan="8" class="py-8 text-center text-gray-500">
            <div class="flex flex-col items-center">
                <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                <p>Tidak ada ticket</p>
            </div>
        </td></tr>`;
    }
    
    $('#ticketTableBody').html(html);
}

function viewTicket(id) {
    currentTicketId = id;
    
    $.ajax({
        url: BASE_URL + 'admin/helpdesk/get_ticket/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const ticket = response.data.ticket;
                const messages = response.data.messages;
                
                $('#viewTitle').text('Ticket #' + ticket.id_ticket);
                $('#viewSubject').text(ticket.subject);
                $('#viewStatus').html(`<span class="px-2 py-1 text-xs rounded-full capitalize ${getStatusColor(ticket.status)}">${ticket.status.replace('_', ' ')}</span>`);
                $('#viewPrioritas').html(`<span class="px-2 py-1 text-xs rounded-full capitalize ${getPrioritasColor(ticket.prioritas)}">${ticket.prioritas}</span>`);
                $('#viewKategori').html(`<span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full capitalize">${ticket.kategori}</span>`);
                $('#viewUser').text(ticket.username + ' (' + ticket.email + ')');
                $('#statusSelect').val(ticket.status);
                
                // Render messages
                let msgHtml = '';
                messages.forEach(msg => {
                    const isAdmin = msg.is_admin == 1;
                    const time = new Date(msg.created_at).toLocaleString('id-ID');
                    msgHtml += `
                        <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} mb-4">
                            <div class="max-w-[80%] ${isAdmin ? 'bg-emerald-100' : 'bg-gray-100'} rounded-xl px-4 py-3">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-medium ${isAdmin ? 'text-emerald-700' : 'text-gray-700'}">${msg.username} ${isAdmin ? '(Admin)' : ''}</span>
                                    <span class="text-xs text-gray-400">${time}</span>
                                </div>
                                <p class="text-sm text-gray-800">${msg.pesan}</p>
                            </div>
                        </div>
                    `;
                });
                
                if (messages.length === 0) {
                    msgHtml = '<p class="text-center text-gray-500">Belum ada pesan</p>';
                }
                
                $('#messagesContainer').html(msgHtml);
                $('#messagesContainer').scrollTop($('#messagesContainer')[0].scrollHeight);
                
                $('#viewModal').removeClass('hidden').addClass('flex');
            }
        }
    });
}

function getStatusColor(status) {
    const colors = {
        'open': 'bg-blue-100 text-blue-700',
        'in_progress': 'bg-yellow-100 text-yellow-700',
        'resolved': 'bg-green-100 text-green-700',
        'closed': 'bg-gray-100 text-gray-700'
    };
    return colors[status] || 'bg-gray-100 text-gray-700';
}

function getPrioritasColor(prioritas) {
    const colors = {
        'rendah': 'bg-gray-100 text-gray-700',
        'sedang': 'bg-blue-100 text-blue-700',
        'tinggi': 'bg-orange-100 text-orange-700',
        'urgent': 'bg-red-100 text-red-700'
    };
    return colors[prioritas] || 'bg-gray-100 text-gray-700';
}

function closeViewModal() {
    $('#viewModal').addClass('hidden').removeClass('flex');
    $('#replyMessage').val('');
}

function updateStatus() {
    const status = $('#statusSelect').val();
    if (!status) return;
    
    $.ajax({
        url: BASE_URL + 'admin/helpdesk/update_status/' + currentTicketId,
        type: 'POST',
        data: { status: status },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification('Status berhasil diperbarui', 'success');
                viewTicket(currentTicketId);
                loadTickets();
            } else {
                showNotification(response.message, 'error');
            }
        }
    });
}

function sendReply() {
    const pesan = $('#replyMessage').val().trim();
    if (!pesan) {
        showNotification('Pesan tidak boleh kosong', 'error');
        return;
    }
    
    $.ajax({
        url: BASE_URL + 'admin/helpdesk/reply/' + currentTicketId,
        type: 'POST',
        data: { pesan: pesan },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification('Balasan berhasil dikirim', 'success');
                $('#replyMessage').val('');
                viewTicket(currentTicketId);
                loadTickets();
            } else {
                showNotification(response.message, 'error');
            }
        }
    });
}

function deleteTicket(id) {
    currentTicketId = id;
    $('#deleteModal').removeClass('hidden').addClass('flex');
}

function closeDeleteModal() {
    $('#deleteModal').addClass('hidden').removeClass('flex');
}

function confirmDelete() {
    $.ajax({
        url: BASE_URL + 'admin/helpdesk/delete/' + currentTicketId,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification('Ticket berhasil dihapus', 'success');
                closeDeleteModal();
                loadTickets();
            } else {
                showNotification(response.message, 'error');
            }
        }
    });
}

function showNotification(message, type = 'info') {
    const colors = {
        success: 'from-green-500 to-emerald-600',
        error: 'from-red-500 to-pink-600',
        info: 'from-blue-500 to-cyan-600'
    };
    
    const notification = $(`
        <div class="fixed top-4 right-4 z-50 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-in">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
            </div>
            <div class="flex-1">
                <p class="font-medium">${message}</p>
            </div>
        </div>
    `);
    
    $('body').append(notification);
    
    setTimeout(function() {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}
</script>

<style>
@keyframes slide-in {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
.animate-slide-in { animation: slide-in 0.3s ease-out; }
</style>
