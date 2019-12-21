<!-- メール本文のテンプレート -->
<a href="{{ route('password.reset', ['token' => $token]) }}">
  パスワード再設定リンク
</a>